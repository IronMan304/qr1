

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
      
     

 <div class="row mt-4">
    <!-- Pie Chart Column -->
    <div class="col-md-6">
        <canvas id="attendanceChart"></canvas>
    </div>

    <!-- Tables Column -->
    <div class="col-md-6">
        <h4 class="text-success">Present</h4>
        <table id="presentTable" class="table table-bordered" style="display:none;">
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
        <table id="absentTable" class="table table-bordered" style="display:none;">
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

                    // Fetch updated data from backend
                    fetch('/attendance/fetch', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ date: '{{ $dateFilter }}' })
                    })
                    .then(res => res.json())
                    .then(data => {
                        // Update chart values
                        attendanceChart.data.datasets[0].data = [data.totalPresent, data.totalAbsent];
                        attendanceChart.update();

                        // Update tables
                        const presentTable = document.getElementById('presentTable');
                        const absentTable = document.getElementById('absentTable');
                        presentTable.style.display = 'none';
                        absentTable.style.display = 'none';

                        if (label === 'Present') {
                            presentTable.style.display = 'table';
                            presentTable.querySelector('tbody').innerHTML = data.present.map((s, i) =>
                                `<tr><td>${i+1}</td><td>${s.uid}</td><td>${s.name}</td></tr>`
                            ).join('');
                        } else {
                            absentTable.style.display = 'table';
                            absentTable.querySelector('tbody').innerHTML = data.absent.map((s, i) =>
                                `<tr><td>${i+1}</td><td>${s.uid}</td><td>${s.name}</td></tr>`
                            ).join('');
                        }
                    });
                }
            }
        }
    });
</script>

