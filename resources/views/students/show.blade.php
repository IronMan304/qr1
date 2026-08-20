<x-app-layout>
<div class="content">
    <div class="page-header">
        <h3>{{ $student->full_name }} - Exams Taken</h3>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Exam Type</th>
                        <th>Module</th>
                        <th>Subject</th>
                        <th>Score</th>
                        <th>Max Score</th>
                        <th>Date Recorded</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($scores as $score)
                        <tr>
                            <td>{{ $score->examType->name }}</td>
                            <td>{{ $score->subject->module->name ?? ''}}</td>
                            <td>{{ $score->subject->name }}</td>
                            <td>{{ $score->score }}</td>
                            <td>{{ $score->max_score }}</td>
                            <td>{{ $score->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No exams recorded for this student.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
