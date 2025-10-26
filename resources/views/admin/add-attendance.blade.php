<x-admin.layout>
    <x-slot name="title">Branch Master</x-slot>
    <x-slot name="heading">Add Branch Master</x-slot>


    <!-- Add Form -->
    <div class="row" id="addContainer">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="month_id">Month <span class="text-danger">*</span></label>
                                   <select class="form-select " id="month_id" name="month_id">
                                    <option value="">Select Month</option>
                                    
                                    <option value="1">January</option>
                                    <option value="2">Feb</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                    
                                </select>           
                               <span class="text-danger invalid month_id_err"></span>
                            </div>

                             <div class="col-md-4">
                                <label class="col-form-label" for="employee_id">Select Employee <span class="text-danger">*</span></label>
                                   <select class="form-select " id="employee_id" name="employee_id">
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->first_name . " ". $employee->last_name }}</option>                                                                
                                    @endforeach
                                </select>           
                               <span class="text-danger invalid employee_id_err"></span>
                            </div>
                        
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="type">Select Type <span class="text-danger">*</span></label>
                                   <select class="form-select " id="type" name="type">
                                    <option value="">Select Type</option>
                                    
                                    <option value="1">Present</option>                                                                
                                    <option value="2">Absent</option>        
                                    <option value="3">Half Day</option>        

                                    
                                </select>           
                               <span class="text-danger invalid type_err"></span>
                            </div>  

                            <div class="col-md-4">
                                <label class="col-form-label" for="total_present_days">Total Present Days <span class="text-danger">*</span></label>
                                <input class="form-control" id="total_present_days" name="total_present_days" type="text" placeholder="Enter Total Present Days" readonly>
                                <span class="text-danger invalid total_present_days_err"></span>
                            </div>

                            <div class="col-md-4" style="display:none">
                                <label class="col-form-label" for="present_days"> Present Days <span class="text-danger">*</span></label>
                                <input class="form-control" id="present_days" name="present_days" type="text" placeholder="Enter Present Days">
                                <span class="text-danger invalid present_days_err"></span>
                            </div>

                            <div class="col-md-4" style="display:none">
                                <label class="col-form-label" for="absent_days"> Absent Days <span class="text-danger">*</span></label>
                                <input class="form-control" id="absent_days" name="absent_days" type="text" placeholder="Enter Absent Days">
                                <span class="text-danger invalid absent_days_err"></span>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-success" id="searchBtn">Search</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-admin.layout><script>
let currentAttendance = null;

// Initially hide Type and day fields + hide submit button
$("#type").closest(".col-md-4").hide();
$("#present_days").closest(".col-md-4").hide();
$("#absent_days").closest(".col-md-4").hide();

// Hide Submit button initially
let submitBtn = $('<button type="submit" class="btn btn-primary" id="submitBtn" style="display:none;">Submit</button>');
$(".card-footer").append(submitBtn);

// Search attendance
$("#searchBtn").on("click", function(e) {
    e.preventDefault();

    let month_id = $("#month_id").val();
    let employee_id = $("#employee_id").val();

    if (!month_id || !employee_id) {
        alert("Please select both month and employee!");
        return;
    }

    $.ajax({
        url: "{{ route('attendance.search') }}",
        type: 'GET',
        data: { month_id, employee_id },
        success: function(res) {
            console.log(res);
            currentAttendance = res;

            $("#total_present_days").val(res.present_days ?? 0);

            // Show Type field now
            $("#type").closest(".col-md-4").show();

            // Hide Search, show Submit
            $("#searchBtn").hide();
            $("#submitBtn").show();

            alert("Data fetched successfully.");
        },
        error: function() {
            alert("Error while fetching data.");
        }
    });
});

// When Type changes → show correct input field
$("#type").on("change", function() {
    if (!currentAttendance) {
        alert("Please search attendance first!");
        $(this).val('');
        return;
    }

    let type = $(this).val();

    // Hide all input fields first
    $("#present_days").closest(".col-md-4").hide();
    $("#absent_days").closest(".col-md-4").hide();

    // Show field based on type
    if (type == "1") {
        $("#present_days").closest(".col-md-4").show();
        $("#present_days").val("");
    } 
    else if (type == "2") {
        $("#absent_days").closest(".col-md-4").show();
        $("#absent_days").val("");
    } 
    else if (type == "3") {
        $("#absent_days").closest(".col-md-4").show();
        $("#absent_days").val("0.5");
    }
});

// When user inputs value → update total dynamically
$("#present_days, #absent_days").on("input", function() {
    if (!currentAttendance) return;

    let basePresent = parseFloat(currentAttendance.present_days ?? 0);
    let totalDays = parseFloat(currentAttendance.total_days ?? 0);
    let type = $("#type").val();
    let value = parseFloat($(this).val()) || 0;

    let total = basePresent;

    if (type == "1") total = basePresent + value;   // Present
    if (type == "2") total = basePresent - value;   // Absent
    if (type == "3") total = basePresent - 0.5;     // Half day

    // Prevent negatives and overflows
    if (total < 0) total = 0;
    if (total > totalDays) {
        alert(`Total present days cannot exceed total days (${totalDays})`);
        total = totalDays;
        $(this).val(''); // clear wrong input
    }

    $("#total_present_days").val(total.toFixed(1));
});

// On form submit → update attendance
$(document).on("submit", "#addForm", function(e) {
    e.preventDefault();

    let month_id = $("#month_id").val();
    let employee_id = $("#employee_id").val();
    let type = $("#type").val();
    let present_days = $("#total_present_days").val();
    let absent_days = $("#absent_days").val();

    $.ajax({
        url: "{{ route('attendance.updateDays') }}",
        type: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            month_id,
            employee_id,
            type,
            present_days,
            absent_days
        },
        success: function(res) {
            alert(res.message);

            // Reset form for new search
            $("#addForm")[0].reset();
            $("#type").closest(".col-md-4").hide();
            $("#present_days").closest(".col-md-4").hide();
            $("#absent_days").closest(".col-md-4").hide();

            // Show Search again, hide Submit
            $("#searchBtn").show();
            $("#submitBtn").hide();

            currentAttendance = null;
        },
        error: function() {
            alert("Something went wrong!");
        }
    });
});
</script>
