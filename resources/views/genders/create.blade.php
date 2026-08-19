<x-app-layout>
<div class="content">
    <h3>Add Gender</h3>
    <form action="{{ route('genders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('genders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
