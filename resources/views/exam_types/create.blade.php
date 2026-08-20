<x-app-layout>
<div class="content">
    <h3>Add Exam Type</h3>
    <form action="{{ route('exam_types.store') }}" method="POST">
        @csrf
        <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control"></div>
        <div class="mb-3"><label>Description</label><textarea name="description" class="form-control"></textarea></div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('exam_types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
