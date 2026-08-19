<x-app-layout>
<div class="content">
    <h3>Edit Course</h3>
    <form action="{{ route('courses.update',$course->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3"><label>Code</label><input type="text" name="code" class="form-control" value="{{ $course->code }}"></div>
        <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" value="{{ $course->name }}"></div>
        <div class="mb-3"><label>Description</label><textarea name="description" class="form-control">{{ $course->description }}</textarea></div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
