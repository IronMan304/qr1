<x-app-layout>
<div class="content">
    <h3>Add Course</h3>
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="mb-3"><label>Code</label><input type="text" name="code" class="form-control"></div>
        <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control"></div>
        <div class="mb-3"><label>Description</label><textarea name="description" class="form-control"></textarea></div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
