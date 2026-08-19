<x-app-layout>
<div class="content">
    <h3>Add Student</h3>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mb-3"><label>ID Number</label><input type="text" name="id_number" class="form-control"></div>
        <div class="mb-3"><label>First Name</label><input type="text" name="first_name" class="form-control"></div>
        <div class="mb-3"><label>Middle Name</label><input type="text" name="middle_name" class="form-control"></div>
        <div class="mb-3"><label>Last Name</label><input type="text" name="last_name" class="form-control"></div>
        <div class="mb-3"><label>Gender</label>
            <select name="gender_id" class="form-control">
                @foreach($genders as $gender)
                    <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Course</label>
            <select name="course_id" class="form-control">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
