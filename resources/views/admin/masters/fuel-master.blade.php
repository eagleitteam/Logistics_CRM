<x-admin.layout>
    <x-slot name="title">Advanced Fuel Management</x-slot>
    <x-slot name="heading">Advanced Fuel Management</x-slot>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title"><i class="fas fa-gas-pump me-2"></i> Advanced Fuel Management</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFuelModal">
                            <i class="fas fa-plus me-2"></i>Add Fuel Record
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Vehicle Selection Section -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <label for="vehicleSelect" class="form-label">Select Vehicle</label>
                             <select class="form-select" name="vehical_number" id="vehicleNo" required>
                                <option value="">-- Select Vehicle Number --</option>
                                @foreach ($SelfVehicle as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="reportPeriod" class="form-label">Report Period</label>
                            <select class="form-select" id="reportPeriod">
                                <option value="7"selected>Last 7 Days</option>
                                <option value="30">Last 30 Days</option>
                                <option value="90">Last 90 Days</option>
                                <option value="365">Last 1 Year</option>
                                <option value="custom">Custom Range</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Vehicle Dashboard (shown after selection) -->
                    <div id="vehicleDashboard" style="display: none;">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h4 id="vehicleTitle">Vehicle: MH 04 KF 7256</h4>
                                        <p class="text-muted" id="vehicleLastFuel">Last Fuel: 05 Jan 2025 | Last Odometer: 133,513.2 km</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-tachometer-alt fa-2x text-primary"></i>
                                        <div class="value" id="currentAvg">5.2 km/L</div>
                                        <div class="label">Current Avg</div>
                                        <div class="mt-2">
                                            <span id="avgChange" class="badge bg-success">+0.3 km/L</span> vs last month
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-calendar-alt fa-2x text-success"></i>
                                        <div class="value" id="monthlyAvg">5.0 km/L</div>
                                        <div class="label">Monthly Avg</div>
                                        <div class="progress mt-2">
                                            <div class="progress-bar" role="progressbar" style="width: 85%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-calendar fa-2x text-warning"></i>
                                        <div class="value" id="yearlyAvg">4.8 km/L</div>
                                        <div class="label">Yearly Avg</div>
                                        <div class="progress mt-2">
                                            <div class="progress-bar" role="progressbar" style="width: 75%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-users fa-2x text-danger"></i>
                                        <div class="value" id="driverCount">4</div>
                                        <div class="label">Drivers This Month</div>
                                        <div class="mt-2">
                                            <span id="driverChange" class="badge bg-danger">-1</span> vs last month
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-chart-line me-2"></i>Fuel Efficiency Trend
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="efficiencyChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-2"></i>Monthly Comparison
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="comparisonChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        


                        <!-- table start -->
                            <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            @can('fuelmaster.create')
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="">
                                                                <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
                                                                <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr No.</th>
                                                                <th>Date</th>
                                                                <th>Odometer</th>
                                                                <th>Fuel Qty</th>
                                                                <th>Fuel Rate</th>
                                                                <th>Fuel Price</th>
                                                                <th>Payment Mode</th>
                                                                <th>Distance</th>
                                                                <th>Efficiency</th>
                                                                <th>Driver</th>
                                                                <th>Note</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($fuelmasters as $fuelmasters)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $fuelmasters->date }}</td>
                                                                    <td>{{ $fuelmasters->current_km }}</td>
                                                                    <td>{{ $fuelmasters->fuel_qty }}</td>
                                                                    <td>{{ $fuelmasters->fuel_rate }}</td>
                                                                    <td>{{ $fuelmasters->fuel_amt }}</td>
                                                                    <td>{{ $fuelmasters->payment_method }}</td>
                                                                    <td>{{ $fuelmasters->distance }}</td>
                                                                    <td>{{ $fuelmasters->avg }}</td>
                                                                    <td>{{ $fuelmasters->driver_name }}</td>
                                                                    <td>{{ $fuelmasters->note }}</td>

                                                                    <td>
                                                                        @can('fuelmaster.edit')
                                                                            <button class="edit-element btn btn-secondary px-2 py-1" title="Edit fuel" data-id="{{ $fuelmasters->id }}"><i data-feather="edit"></i></button>
                                                                        @endcan
                                                                        @can('fuelmaster.delete')
                                                                            <button class="btn btn-danger rem-element px-2 py-1" title="Delete fuel" data-id="{{ $fuelmasters->id }}"><i data-feather="trash-2"></i> </button>
                                                                        @endcan
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <!-- table End -->
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-chart-pie me-2"></i>Driver Performance
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="driverChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-exchange-alt me-2"></i>Monthly Comparison
                                    </div>
                                    <div class="card-body">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>Fuel Efficiency</div>
                                                    <div class="fw-bold text-success">5.2 km/L</div>
                                                </div>
                                                <div class="text-end">
                                                    <small class="text-success">+0.3 km/L vs last month</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>Fuel Cost</div>
                                                    <div class="fw-bold text-danger">₹5.2/km</div>
                                                </div>
                                                <div class="text-end">
                                                    <small class="text-danger">+₹0.1/km vs last month</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>Distance Covered</div>
                                                    <div class="fw-bold text-success">4,250 km</div>
                                                </div>
                                                <div class="text-end">
                                                    <small class="text-success">+320 km vs last month</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-trophy me-2"></i>Performance Highlights
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-success">
                                            <i class="fas fa-check-circle me-2"></i>
                                            <strong>Best Efficiency:</strong> 5.8 km/L (Driver: Rajesh, 15 Dec)
                                        </div>
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <strong>Needs Improvement:</strong> 4.2 km/L (Driver: Amit, 22 Dec)
                                        </div>
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <strong>Longest Trip:</strong> 1,250 km (Driver: Sanjay, 5 Jan)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add Fuel Modal -->
    <div class="modal fade" id="addFuelModal" tabindex="-1" aria-labelledby="addFuelModalLabel" style="display:none;" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFuelModalLabel"><i class="fas fa-gas-pump me-2"></i>Add Fuel Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                   
                         @csrf
                <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fuelDate" class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" id="fuelDate" required>
                            </div>
                           <div class="col-md-6 mb-3">
                            <label for="vehicleNo" class="form-label">Vehicle Number</label>
                            <select class="form-select" name="vehical_number" id="vehicleNo" required>
                                <option value="">-- Select Vehicle Number --</option>
                                @foreach ($SelfVehicle as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="currentKM" class="form-label">Current Odometer (KM)</label>
                                <input type="number" step="0.1" class="form-control" name="current_km" id="currentKM" required>
                                <small class="text-muted" id="lastKMText">Last recorded: 133,513.2 km</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="fuelQuantity" class="form-label">Fuel Quantity (Ltr)</label>
                                <input type="number" step="0.01" class="form-control" name="fuel_qty" id="fuelQuantity" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="fuelRate" class="form-label">Fuel Rate (₹/Ltr)</label>
                                <input type="number" step="0.01" class="form-control" name="fuel_rate" id="fuelRate" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="driverName" class="form-label">Driver Name</label>
                                 <select class="form-select" name="driver_name" id="driverName" required>
                                <option value="">-- Select Driver --</option>
                                @foreach ($drivermasters as $driver)
                                    <option value="{{ $driver->id }}">
                                        {{ $driver->first_name }} {{ $driver->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="paymentMethod" class="form-label">Payment Method</label>
                                <select class="form-select" name="payment_method" id="paymentMethod" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="CASH">Cash</option>
                                    <option value="BANK">Bank Transfer</option>
                                    <option value="GPAY">GPay</option>
                                    <option value="PAYTM">PayTM</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="fuelNotes" class="form-label">Notes</label>
                            <textarea class="form-control" name="note" id="fuelNotes" rows="2"></textarea>
                        </div>
                        
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Distance:</strong> <span  id="calcDistance">0</span> km
                                </div>
                                <div class="col-md-4">
                                    <strong>Amount:</strong> ₹<span  id="calcAmount">0.00</span>
                                </div>
                                <div class="col-md-4">
                                    <strong>Efficiency:</strong> <span  id="calcEfficiency">0.00</span> km/L
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveFuelRecord">Save Fuel Record</button>
                </div>

                <!-- Add these inside your form, before the closing </form> tag -->
                    <input type="hidden" name="distance" id="calcDistance">
                    <input type="hidden" name="fuel_amt" id="calcAmount">
                    <input type="hidden" name="avg" id="calcEfficiency">
                </form>
            </div>
        </div>
    </div>


</x-admin.layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        // Sample data for vehicles
        const vehicleData = {
            "MH04KF7256": {
                name: "MH 04 KF 7256",
                lastKM: 133513.2,
                lastFuelDate: "2025-01-01",
                currentAvg: 5.2,
                monthlyAvg: 5.0,
                yearlyAvg: 4.8,
                driverCount: 4,
                avgChange: 0.3,
                driverChange: -1,
                fuelHistory: [
                    { date: "2025-01-01", km: 133513.2, kmSince: 200, qty: 57.82, rate: 90.42, amount: 5228.08, driver: "Sanjay Patel", efficiency: 3.46 },
                    { date: "2024-12-27", km: 133313.2, kmSince: 350, qty: 57.82, rate: 90.42, amount: 5228.08, driver: "Rajesh Kumar", efficiency: 6.05 },
                    { date: "2024-12-20", km: 132963.2, kmSince: 280, qty: 45.25, rate: 90.15, amount: 4079.29, driver: "Amit Sharma", efficiency: 6.19 },
                    { date: "2024-12-15", km: 132683.2, kmSince: 320, qty: 52.18, rate: 89.95, amount: 4693.59, driver: "Rajesh Kumar", efficiency: 6.13 },
                    { date: "2024-12-10", km: 132363.2, kmSince: 250, qty: 40.15, rate: 89.75, amount: 3603.46, driver: "Vijay Singh", efficiency: 6.23 }
                ],
                driverPerformance: {
                    "Rajesh Kumar": { trips: 12, avgEfficiency: 5.8, totalKM: 3850 },
                    "Amit Sharma": { trips: 8, avgEfficiency: 4.9, totalKM: 2450 },
                    "Sanjay Patel": { trips: 5, avgEfficiency: 5.2, totalKM: 1800 },
                    "Vijay Singh": { trips: 3, avgEfficiency: 5.5, totalKM: 950 }
                }
            },
            "MH04LY8342": {
                name: "MH 04 LY 8342",
                lastKM: 17655.4,
                lastFuelDate: "2024-12-27",
                currentAvg: 6.1,
                monthlyAvg: 5.8,
                yearlyAvg: 5.5,
                driverCount: 3,
                avgChange: 0.2,
                driverChange: 0,
                fuelHistory: [
                    { date: "2024-12-27", km: 17655.4, kmSince: 420, qty: 80.23, rate: 90.44, amount: 7256.00, driver: "Amit Sharma", efficiency: 5.23 },
                    { date: "2024-12-20", km: 17235.4, kmSince: 380, qty: 72.15, rate: 90.20, amount: 6507.93, driver: "Rajesh Kumar", efficiency: 5.27 },
                    { date: "2024-12-15", km: 16855.4, kmSince: 400, qty: 75.18, rate: 89.95, amount: 6762.44, driver: "Vijay Singh", efficiency: 5.32 }
                ],
                driverPerformance: {
                    "Rajesh Kumar": { trips: 7, avgEfficiency: 5.9, totalKM: 2650 },
                    "Amit Sharma": { trips: 5, avgEfficiency: 5.3, totalKM: 2100 },
                    "Vijay Singh": { trips: 3, avgEfficiency: 5.7, totalKM: 1200 }
                }
            }
        };

        // Initialize charts
        let efficiencyChart, comparisonChart, driverChart;

        // DOM elements
        const vehicleSelect = document.getElementById('vehicleSelect');
        const vehicleDashboard = document.getElementById('vehicleDashboard');
        const vehicleTitle = document.getElementById('vehicleTitle');
        const vehicleLastFuel = document.getElementById('vehicleLastFuel');
        const currentAvg = document.getElementById('currentAvg');
        const monthlyAvg = document.getElementById('monthlyAvg');
        const yearlyAvg = document.getElementById('yearlyAvg');
        const driverCount = document.getElementById('driverCount');
        const avgChange = document.getElementById('avgChange');
        const driverChange = document.getElementById('driverChange');
        const fuelHistoryBody = document.getElementById('fuelHistoryBody');
        const lastKMText = document.getElementById('lastKMText');
        const calcDistance = document.getElementById('calcDistance');
        const calcAmount = document.getElementById('calcAmount');
        const calcEfficiency = document.getElementById('calcEfficiency');

        // Vehicle selection handler
        vehicleSelect.addEventListener('change', function() {
            const selectedVehicle = this.value;
            
            if (selectedVehicle) {
                // Show dashboard
                vehicleDashboard.style.display = 'block';
                
                // Load vehicle data
                const vehicle = vehicleData[selectedVehicle];
                if (vehicle) {
                    loadVehicleData(vehicle);
                } else {
                    // Handle case where vehicle data isn't found
                    vehicleDashboard.style.display = 'none';
                    alert('No data available for selected vehicle');
                }
            } else {
                // Hide dashboard
                vehicleDashboard.style.display = 'none';
            }
        });

        // Load vehicle data
        function loadVehicleData(vehicle) {
            // Update header info
            vehicleTitle.textContent = `Vehicle: ${vehicle.name}`;
            vehicleLastFuel.textContent = `Last Fuel: ${formatDate(vehicle.lastFuelDate)} | Last Odometer: ${formatNumber(vehicle.lastKM)} km`;
            
            // Update metrics
            currentAvg.textContent = `${vehicle.currentAvg} km/L`;
            monthlyAvg.textContent = `${vehicle.monthlyAvg} km/L`;
            yearlyAvg.textContent = `${vehicle.yearlyAvg} km/L`;
            driverCount.textContent = vehicle.driverCount;
            
            // Update changes
            avgChange.textContent = `${vehicle.avgChange > 0 ? '+' : ''}${vehicle.avgChange} km/L`;
            avgChange.className = `badge ${vehicle.avgChange >= 0 ? 'bg-success' : 'bg-danger'}`;
            
            driverChange.textContent = `${vehicle.driverChange > 0 ? '+' : ''}${vehicle.driverChange}`;
            driverChange.className = `badge ${vehicle.driverChange >= 0 ? 'bg-success' : 'bg-danger'}`;
            
            // Load fuel history
            loadFuelHistory(vehicle.fuelHistory);
            
            // Initialize charts
            initCharts(vehicle);
        }

        // Load fuel history
        function loadFuelHistory(history) {
            fuelHistoryBody.innerHTML = '';
            
            history.forEach(record => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${formatDate(record.date)}</td>
                    <td>${formatNumber(record.km)}</td>
                    <td>${formatNumber(record.kmSince)}</td>
                    <td>${record.qty} L</td>
                    <td>₹${record.rate.toFixed(2)}</td>
                    <td>₹${record.amount.toFixed(2)}</td>
                    <td>${record.efficiency.toFixed(2)} km/L</td>
                    <td>${record.driver}</td>
                `;
                fuelHistoryBody.appendChild(row);
            });
        }

        // Initialize charts
        function initCharts(vehicle) {
            // Efficiency Trend Chart
            const efficiencyCtx = document.getElementById('efficiencyChart').getContext('2d');
            
            if (efficiencyChart) {
                efficiencyChart.destroy();
            }
            
            efficiencyChart = new Chart(efficiencyCtx, {
                type: 'line',
                data: {
                    labels: vehicle.fuelHistory.map(record => formatDate(record.date)).reverse(),
                    datasets: [{
                        label: 'Fuel Efficiency (km/L)',
                        data: vehicle.fuelHistory.map(record => record.efficiency).reverse(),
                        borderColor: '#3498db',
                        backgroundColor: 'rgba(52, 152, 219, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `Efficiency: ${context.raw.toFixed(2)} km/L`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            min: Math.floor(Math.min(...vehicle.fuelHistory.map(r => r.efficiency))) - 1
                        }
                    }
                }
            });
            
            // Monthly Comparison Chart
            const comparisonCtx = document.getElementById('comparisonChart').getContext('2d');
            
            if (comparisonChart) {
                comparisonChart.destroy();
            }
            
            comparisonChart = new Chart(comparisonCtx, {
                type: 'bar',
                data: {
                    labels: ['Oct', 'Nov', 'Dec', 'Jan'],
                    datasets: [{
                        label: 'Fuel Efficiency (km/L)',
                        data: [4.7, 4.9, 5.0, 5.2],
                        backgroundColor: '#3498db',
                        borderColor: '#2980b9',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `Avg: ${context.raw.toFixed(2)} km/L`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            min: 4.5
                        }
                    }
                }
            });
            
            // Driver Performance Chart
            const driverCtx = document.getElementById('driverChart').getContext('2d');
            
            if (driverChart) {
                driverChart.destroy();
            }
            
            const driverData = vehicle.driverPerformance;
            const drivers = Object.keys(driverData);
            
            driverChart = new Chart(driverCtx, {
                type: 'bar',
                data: {
                    labels: drivers,
                    datasets: [
                        {
                            label: 'Avg Efficiency (km/L)',
                            data: drivers.map(driver => driverData[driver].avgEfficiency),
                            backgroundColor: '#2ecc71',
                            borderColor: '#27ae60',
                            borderWidth: 1
                        },
                        {
                            label: 'Trips',
                            data: drivers.map(driver => driverData[driver].trips),
                            backgroundColor: '#f39c12',
                            borderColor: '#e67e22',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Helper functions
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-IN');
        }

        function formatNumber(num) {
            return num.toLocaleString('en-IN');
        }

        // Fuel entry form calculations
        document.getElementById('vehicleNo').addEventListener('change', function() {
            const vehicle = vehicleData[this.value];
            if (vehicle) {
                lastKMText.textContent = `Last recorded: ${formatNumber(vehicle.lastKM)} km`;
            } else {
                lastKMText.textContent = 'Last recorded: N/A';
            }
        });

        document.getElementById('currentKM').addEventListener('input', calculateFuelMetrics);
        document.getElementById('fuelQuantity').addEventListener('input', calculateFuelMetrics);
        document.getElementById('fuelRate').addEventListener('input', calculateFuelMetrics);

        function calculateFuelMetrics() {
            const currentKM = parseFloat(document.getElementById('currentKM').value) || 0;
            const vehicleNo = document.getElementById('vehicleNo').value;
            const vehicle = vehicleData[vehicleNo];
            const lastKM = vehicle ? vehicle.lastKM : 0;
            const quantity = parseFloat(document.getElementById('fuelQuantity').value) || 0;
            const rate = parseFloat(document.getElementById('fuelRate').value) || 0;
            
            const distance = currentKM - lastKM;
            const amount = quantity * rate;
            const efficiency = quantity > 0 ? distance / quantity : 0;
            
            calcDistance.textContent = formatNumber(distance);
            calcAmount.textContent = amount.toFixed(2);
            calcEfficiency.textContent = efficiency.toFixed(2);
        }

        // Save fuel record
        // document.getElementById('saveFuelRecord').addEventListener('click', function() {
        //     alert('Fuel record saved successfully!');
        //     // In a real app, you would send this data to your backend
        //     const modal = bootstrap.Modal.getInstance(document.getElementById('addFuelModal'));
        //     modal.hide();
        // });

        // Initialize with first vehicle selected by default (for demo)
        window.addEventListener('DOMContentLoaded', function() {
            vehicleSelect.value = 'MH04KF7256';
            const event = new Event('change');
            vehicleSelect.dispatchEvent(event);
        });
    </script>

<script>
    // Global error handling functions
    function resetErrors() {
        $('.invalid').text('');
    }

    function printErrMsg(msg) {
        $.each(msg, function (key, value) {
            $('.' + key + '_err').text(value[0]);
        });
    }

    $("#addForm").submit(function (e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);

        $.ajax({
            url: '{{ route('fuel-master.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#addSubmit").prop('disabled', false);

                if (!data.error2) {
                    swal("Successful!", data.success, "success")
                        .then(() => {
                            window.location.href = '{{ route('fuel-master.index') }}';
                        });
                } else {
                    swal("Error!", data.error2, "error");
                }
            },
            statusCode: {
                422: function (responseObject) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    if (responseObject.responseJSON && responseObject.responseJSON.errors) {
                        printErrMsg(responseObject.responseJSON.errors);
                    }
                },
                500: function () {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occurred!", "Something went wrong, please try again", "error");
                }
            }
        });
    });
</script>



