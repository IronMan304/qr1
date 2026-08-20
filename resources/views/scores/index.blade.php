<x-app-layout>
<div class="content">
    <h3>Scores</h3>
    <a href="{{ route('scores.create') }}" class="btn btn-primary">Add Score</a>
    <table class="table mt-3">
        <thead>
            <tr><th>Student</th><th>Subject</th><th>Exam Type</th><th>Score</th><th>Max</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($scores as $score)
                <tr>
                    <td>{{ $score->student->first_name }} {{ $score->student->middle_name }} {{ $score->student->last_name }}</td>
                    <td>{{ $score->subject->name }}</td>
                    <td>{{ $score->examType->name }}</td>
                    <td>{{ $score->score }}</td>
                    <td>{{ $score->max_score }}</td>
                    <td>
                        <a href="{{ route('scores.edit',$score->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('scores.destroy',$score->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $scores->links('pagination::bootstrap-5') }}
</div>
</x-app-layout>
