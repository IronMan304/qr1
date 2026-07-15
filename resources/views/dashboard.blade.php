

<x-app-layout>

    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="good-morning-blk">
            <div class="row">
                <div class="col-md-6">
                    <div class="morning-user">

                        <p>Have a nice day at work</p>
                    </div>
                </div>
                <div class="col-md-6 position-blk">
                    <div class="morning-img">
                        <img src="assets/img/morning-img-01.png" alt>
                    </div>
                </div>
            </div>
        </div>
      
     

  <div class="container mt-4">
    <h3>Attendance for {{ $dateFilter }}</h3>

    <div class="row mb-3">
        <div class="col">
            <strong>Total Students:</strong> {{ $totalStudents }}
        </div>
        <div class="col text-success">
            <strong>Total Present:</strong> {{ $totalPresent }}
        </div>
        <div class="col text-danger">
            <strong>Total Absent:</strong> {{ $totalAbsent }}
        </div>
    </div>

    <h4 class="text-success">Present</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>UID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($present as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student['uid'] }}</td>
                    <td>{{ $student['name'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="text-danger">Absent</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>UID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absent as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student['uid'] }}</td>
                    <td>{{ $student['name'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>




    </div>
</x-app-layout>
