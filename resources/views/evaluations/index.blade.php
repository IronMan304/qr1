<x-app-layout>
<div class="content">
    <h3>Evaluations</h3>
    <a href="{{ route('evaluations.create') }}" class="btn btn-primary">Add Evaluation</a>
    <table class="table mt-3">
        <thead>
            <tr><th>Student</th><th>Subject</th><th>Assessment Type</th><th>Weight</th><th>Grade</th><th>Points</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($evaluations as $evaluation)
                <tr>
                    <td>{{ $evaluation->student->first_name ?? 'N/A' }}</td>
                    <td>{{ $evaluation->subject->name ?? 'N/A' }}</td>
                    <td>{{ $evaluation->assessmentType->name ?? 'N/A' }}</td>
                    <td>{{ $evaluation->weight }}</td>
                    <td>{{ $evaluation->grade }}</td>
                    <td>{{ $evaluation->points }}</td>
                    <td>
                        <a href="{{ route('evaluations.edit',$evaluation->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('evaluations.destroy',$evaluation->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this evaluation?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $evaluations->links('pagination::bootstrap-5') }}
</div>
</x-app-layout>
