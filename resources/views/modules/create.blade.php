<x-app-layout>
<div class="content">
    <h3>Add Module</h3>
    <form action="{{ route('modules.store') }}" method="POST">
        @csrf
        <div class="mb-3"><label>Code</label><input type="text" name="code" class="form-control"></div>
    <div class="mb-3">
    <label>Course</label>
    <select name="course_id" class="form-control">
        @foreach($courses as $course)
            <option value="{{ $course->id }}"
                {{ isset($module) && $module->course_id == $course->id ? 'selected' : '' }}>
                {{ $course->name }}
            </option>
        @endforeach
    </select>
</div>



        <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control"></div>
        <div class="mb-3"><label>Subjects</label>
            <select name="subjects[]" class="form-control" multiple>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('modules.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
