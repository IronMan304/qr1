<x-app-layout>
<div class="content">
    <h3>Edit Gender</h3>
    <form action="{{ route('genders.update', $gender->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $gender->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('genders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
