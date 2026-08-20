<x-app-layout>
<div class="content">
    <h3>Edit Exam Type</h3>
    <form action="{{ route('exam_types.update',$examType->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3"><label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $examType->name }}">
        </div>
        <div class="mb-3"><label>Description</label>
            <textarea name="description" class="form-control">{{ $examType->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('exam_types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
