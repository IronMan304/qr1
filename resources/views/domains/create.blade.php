<x-app-layout>
<div class="content">
    <h3>Add Domain</h3>
    <form action="{{ route('domains.store') }}" method="POST">
        @csrf
        <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control"></div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('domains.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
