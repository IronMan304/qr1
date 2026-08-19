<x-app-layout>
<div class="content">
    <div class="page-header">
        <h3>Courses List</h3>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr><th>Code</th><th>Name</th><th>Description</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->code }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->description }}</td>
                            <td>
                                <a href="{{ route('courses.edit',$course->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('courses.destroy',$course->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $courses->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
</x-app-layout>
