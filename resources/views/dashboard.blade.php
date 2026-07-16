

<style>
    #presentTable, #absentTable {
        display: none;
    }
</style>

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

        <div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center p-3">
            <h5>Total Students</h5>
            <h3>{{ $totalStudents }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center p-3">
            <h5 class="text-success">Present</h5>
            <h3>{{ $totalPresent }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center p-3">
            <h5 class="text-danger">Absent</h5>
            <h3>{{ $totalAbsent }}</h3>
        </div>
    </div>
</div>


        <form method="GET" action="{{ url()->current() }}" class="mb-3">
    <div class="row align-items-end">
        <div class="col-md-4">
            <label>Select Date</label>
            <input type="date" name="date" value="{{ $dateFilter }}" class="form-control">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>

<h4 class="text-primary">
    Attendance for {{ \Carbon\Carbon::parse($dateFilter)->format('F d, Y') }}
</h4>

       
      
     

<div class="row mt-4">
    <!-- Pie Chart -->
    <div class="col-md-6">
        <canvas id="attendanceChart"></canvas>
    </div>

    <!-- Unified Table -->
    <div class="col-md-6">
       <h4 id="tableTitle" class="text-primary">
    @if(request('status') === 'present')
        Present Students
    @elseif(request('status') === 'absent')
        Absent Students
    @else
        All Students
    @endif
</h4>

        <div class="table-responsive">  
         <table id="studentsTable" class="table border-0 custom-table comman-table mb-0">
            
            <thead>
                <tr>
                    <th>#</th>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Time In</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($studentsPaginated as $student)
        <tr>
            <td>{{ $loop->iteration + ($studentsPaginated->currentPage() - 1) * $studentsPaginated->perPage() }}</td>
            <td>{{ $student['uid'] }}</td>
            <td>{{ $student['name'] }}</td>
            <td class="{{ $student['status'] === 'Present' ? 'text-success' : 'text-danger' }}">
                {{ $student['status'] }}
            </td>
            <td>
    {{ $student['status'] === 'Present' ? ($student['time'] ?? '-') : '-' }}
</td>

        </tr>
    @endforeach
</tbody>

            </table>
</div>
        <!-- Pagination Links -->
<div class="d-flex justify-content-center mt-3">
    {{ $studentsPaginated->links('pagination::bootstrap-5') }}
</div>
    </div>
</div>




    </div>
</x-app-layout>
<script>
const ctx = document.getElementById('attendanceChart').getContext('2d');

const attendanceChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Present', 'Absent'],
        datasets: [{
            data: [{{ $totalPresent }}, {{ $totalAbsent }}],
            backgroundColor: ['#28a745', '#dc3545'],
            borderColor: ['#ffffff', '#ffffff'],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' },
            title: { display: true, text: 'Attendance Distribution' }
        },
        onClick: (evt, elements) => {
            if (elements.length > 0) {
                const index = elements[0].index;
                const label = attendanceChart.data.labels[index];

                const date = document.querySelector('input[name="date"]').value;

                let status = '';
                if (label === 'Present') status = 'present';
                if (label === 'Absent') status = 'absent';

                window.location.href = `?date=${date}&status=${status}`;
            }
        }
    }
});
</script>


