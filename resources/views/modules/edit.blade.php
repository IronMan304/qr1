<x-app-layout>
<div class="content">
    <h3>Edit Module</h3>
    <form action="{{ route('modules.update',$module->id) }}" method="POST">
        @csrf @method('PUT')

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



        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control" value="{{ $module->code }}">
        </div>

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $module->name }}">
        </div>

        <div class="mb-3">
            <label>Subjects</label>
            <select name="subjects[]" class="form-control" multiple>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}"
                        {{ $module->subjects->contains($subject->id) ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('modules.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
