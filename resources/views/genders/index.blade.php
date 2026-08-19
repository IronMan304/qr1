<x-app-layout>
<div class="content">
    <div class="page-header">
        <h3>Gender List</h3>
        <a href="{{ route('genders.create') }}" class="btn btn-primary">Add Gender</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr><th>Name</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @foreach($genders as $gender)
                        <tr>
                            <td>{{ $gender->name }}</td>
                            <td>
                                <a href="{{ route('genders.edit', $gender->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('genders.destroy', $gender->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $genders->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
</x-app-layout>
