<x-app-layout>
<div class="content">
    <h3>{{ $student->full_name }} - Assessments</h3>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>

    <!-- Topic Assessments -->
    <div class="card mt-3">
        <div class="card-header"><strong>Topic Assessments</strong></div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Modules (Student's Course)</th>
                        <th>Weight</th>
                        <th>Grade</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topicAssessments as $ta)
                        <tr>
                            <td>{{ $ta->subject->name }}</td>
                            <td>
                                @foreach($ta->subject->modules as $mod)
                                    <span class="badge bg-info">{{ $mod->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $ta->weight }}</td>
                            <td>{{ $ta->grade }}</td>
                            <td>{{ $ta->points }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No topic assessments recorded.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Module Assessments -->
    <div class="card mt-3">
        <div class="card-header"><strong>Module Assessments</strong></div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Weight</th>
                        <th>Grade</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($moduleAssessments as $ma)
                        <tr>
                            <td>{{ $ma->module->name }}</td>
                            <td>{{ $ma->weight }}</td>
                            <td>{{ $ma->grade }}</td>
                            <td>{{ $ma->points }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No module assessments recorded.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
