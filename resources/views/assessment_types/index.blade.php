<x-app-layout>
<div class="content">
    <h3>Assessment Types</h3>
    <a href="{{ route('assessment_types.create') }}" class="btn btn-primary">Add Assessment Type</a>
    <table class="table mt-3">
        <thead>
            <tr><th>Name</th><th>Domain</th><th>Weight</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($assessmentTypes as $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->domain->name }}</td>
                    <td>{{ $type->weight }}</td>
                    <td>
                        <a href="{{ route('assessment_types.edit',$type->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('assessment_types.destroy',$type->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $assessmentTypes->links('pagination::bootstrap-5') }}
</div>
</x-app-layout>
