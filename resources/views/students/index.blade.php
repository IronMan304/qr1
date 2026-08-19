<x-app-layout>
<div class="content">
    <div class="page-header">
        <h3>Students List</h3>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr><th>ID #</th><th>Name</th><th>Gender</th><th>Course</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id_number }}</td>
                            <td>{{ $student->full_name }}</td>
                            <td>{{ $student->gender->name }}</td>
                            <td>{{ $student->course->name }}</td>
                            <td>
                                <a href="{{ route('students.edit',$student->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('students.destroy',$student->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $students->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
</x-app-layout>
