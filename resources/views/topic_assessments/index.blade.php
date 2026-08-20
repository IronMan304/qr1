<x-app-layout>
<div class="content">
    <h3>Topic Assessments</h3>
    <a href="{{ route('topic_assessments.create') }}" class="btn btn-primary">Add Topic Assessment</a>
    <table class="table mt-3">
        <thead>
            <tr><th>Student</th><th>Subject</th><th>Weight</th><th>Grade</th><th>Points</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($assessments as $a)
                <tr>
                    <td>{{ $a->student->first_name }} {{ $a->student->last_name }}</td>
                    <td>{{ $a->subject->name }}</td>
                    <td>{{ $a->weight }}</td>
                    <td>{{ $a->grade }}</td>
                    <td>{{ $a->points }}</td>
                    <td>
                        <a href="{{ route('topic_assessments.edit',$a->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('topic_assessments.destroy',$a->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $assessments->links('pagination::bootstrap-5') }}
</div>
</x-app-layout>
