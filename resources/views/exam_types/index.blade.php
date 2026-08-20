<x-app-layout>
<div class="content">
    <h3>Exam Types</h3>
    <a href="{{ route('exam_types.create') }}" class="btn btn-primary">Add Exam Type</a>
    <table class="table mt-3">
        <thead>
            <tr><th>Name</th><th>Description</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($examTypes as $examType)
                <tr>
                    <td>{{ $examType->name }}</td>
                    <td>{{ $examType->description }}</td>
                    <td>
                        <a href="{{ route('exam_types.edit',$examType->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('exam_types.destroy',$examType->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $examTypes->links('pagination::bootstrap-5') }}
</div>
</x-app-layout>
<x-app-layout>
<div class="content">
    <h3>Exam Types</h3>
    <a href="{{ route('exam_types.create') }}" class="btn btn-primary">Add Exam Type</a>
    <table class="table mt-3">
        <thead>
            <tr><th>Name</th><th>Description</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($examTypes as $examType)
                <tr>
                    <td>{{ $examType->name }}</td>
                    <td>{{ $examType->description }}</td>
                    <td>
                        <a href="{{ route('exam_types.edit',$examType->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('exam_types.destroy',$examType->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $examTypes->links('pagination::bootstrap-5') }}
</div>
</x-app-layout>
