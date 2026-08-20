<x-app-layout>
<div class="content">
    <h3>Domains</h3>
    <a href="{{ route('domains.create') }}" class="btn btn-primary">Add Domain</a>
    <table class="table mt-3">
        <thead>
            <tr><th>Name</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($domains as $domain)
                <tr>
                    <td>{{ $domain->name }}</td>
                    <td>
                        <a href="{{ route('domains.edit',$domain->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('domains.destroy',$domain->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $domains->links('pagination::bootstrap-5') }}
</div>
</x-app-layout>
