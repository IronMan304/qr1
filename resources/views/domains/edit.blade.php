<x-app-layout>
<div class="content">
    <h3>Edit Domain</h3>
    <form action="{{ route('domains.update',$domain->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3"><label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $domain->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('domains.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
