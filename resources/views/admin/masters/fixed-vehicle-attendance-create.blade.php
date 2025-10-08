<x-admin.layout>
    <x-slot name="title">Fix Vehicle Attendance Master</x-slot>
    <x-slot name="heading">Fix Vehical Attendance Master</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


    <div class="row" id="addContainer" >
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="vehicle_id">Select Vehicle Number <span class="text-danger">*</span></label>
                                <select class="form-control" id="vehicle_id" name="vehicle_id">
                                    <option value="">Select Vehicle Number</option>
                                    @foreach ($VehicleNo as $VehicleNo)
                                        <option value="{{ $VehicleNo->id }}">
                                            {{ $VehicleNo->self_vehicle_id ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger invalid vehicle_id_err"></span>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success" id="addSubmit">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <div class="row" id="addContainer" >
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                                <input class="form-control" id="title" name="title" type="text" placeholder="Enter Tiatel">
                                <span class="text-danger invalid title_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" >
                                <span class="text-danger invalid start_date_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" >
                                <span class="text-danger invalid end_date_err"></span>
                            </div>
                            
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success" id="addSubmit">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   

</x-admin.layout>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tbody = document.getElementById("attendanceTbody");
    const today = new Date();
    const fixVehicleClientId = "{{ $fixvehicleclient->id }}";
    const startDate = new Date("{{ $fixvehicleclient->start_date }}");
    const endDate = new Date("{{ $fixvehicleclient->end_date }}");

    for (let dt = new Date(startDate); dt <= endDate; dt.setDate(dt.getDate() + 1)) {
        let dateStr = dt.toISOString().split("T")[0];

        const isFuture = dt > today;

        const row = document.createElement("tr");

        row.innerHTML = `
            <td><input type="date" name="date[]" class="form-control" value="${dateStr}" readonly></td>
            <td>
                <select name="status[]" class="form-select" ${isFuture ? "disabled" : ""}>
                    <option value="1">Present</option>
                    <option value="0">Absent</option>
                    <option value="2">Holiday</option>
                </select>
            </td>
            <td><input type="number" name="start_km[]" class="form-control start-km" ${isFuture ? "readonly" : ""}></td>
            <td><input type="number" name="end_km[]" class="form-control end-km" ${isFuture ? "readonly" : ""}></td>
            <td><input type="number" name="distance[]" class="form-control distance" readonly></td>
            <td><input type="number" name="toll[]" class="form-control" ${isFuture ? "readonly" : ""}></td>
            <td><input type="text" name="pod_no[]" class="form-control" ${isFuture ? "readonly" : ""}></td>
            <td><input type="file" name="pod_doc[]" class="form-control" ${isFuture ? "disabled" : ""}></td>
            <td><input type="text" name="remarks[]" class="form-control" ${isFuture ? "readonly" : ""}></td>
            <input type="hidden" name="fix_vehicle_client_id[]" value="${fixVehicleClientId}">
        `;

        tbody.appendChild(row);

        // Dynamic POD No / POD Doc red highlight
        if (!isFuture) {
            const statusSelect = row.querySelector("select[name='status[]']");
            const podNoInput = row.querySelector("input[name='pod_no[]']");
            const podDocInput = row.querySelector("input[name='pod_doc[]']");

            statusSelect.addEventListener("change", function() {
                if (this.value == "1") {
                    podNoInput.style.border = "2px solid red";
                } else {
                    podNoInput.style.border = "";
                    podDocInput.style.border = "";
                }
            });

            podNoInput.addEventListener("input", function() {
                if (this.value.trim() !== "" && statusSelect.value == "1") {
                    podDocInput.style.border = "2px solid red";
                } else {
                    podDocInput.style.border = "";
                }
            });
        }
    }

    // Distance auto-calc
    tbody.addEventListener("input", function(e) {
        if (e.target.classList.contains("start-km") || e.target.classList.contains("end-km")) {
            const row = e.target.closest("tr");
            const start = parseFloat(row.querySelector(".start-km").value) || 0;
            const end = parseFloat(row.querySelector(".end-km").value) || 0;
            row.querySelector(".distance").value = end - start > 0 ? end - start : 0;
        }
    });
});
</script>


