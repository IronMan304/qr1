<x-app-layout>
<div class="content">
    <div class="page-header">
        <h3>Modules List</h3>
        <a href="{{ route('modules.create') }}" class="btn btn-primary">Add Module</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Subjects</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($modules as $module)
                        <tr>
                            <td>{{ $module->code }}</td>
                            <td>{{ $module->name }}</td>
                            <td>{{ $module->course ? $module->course->name : '—' }}</td>
                            <td>
                                @foreach($module->subjects as $subject)
                                    <span class="badge bg-info">{{ $subject->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('modules.edit',$module->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('modules.destroy',$module->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $modules->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
</x-app-layout>
