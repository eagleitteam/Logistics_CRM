<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Vehicle No</th>
            <!-- <th>Driver Name</th> -->
            <th>Trip Date</th>
            <th>From</th>
            <th>To</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tripData as $trip)
        <tr>
            <td>{{ $trip->id }}</td>
            <td>{{ $trip->vehicle_no }}</td>
            <!-- <td>{{ $trip->driver_name }}</td> -->
            <td>{{ $trip->trip_date }}</td>
            <td>{{ $trip->origin }}</td>
            <td>{{ $trip->destination }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
