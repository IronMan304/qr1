<x-app-layout>
<div class="content">
    <h3>Edit Student</h3>
    <form action="{{ route('students.update',$student->id) }}" method="POST">
        @csrf 
        @method('PUT')

        <div class="mb-3">
            <label>ID Number</label>
            <input type="text" name="id_number" class="form-control" value="{{ $student->id_number }}">
        </div>

        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ $student->first_name }}">
        </div>

        <div class="mb-3">
            <label>Middle Name</label>
            <input type="text" name="middle_name" class="form-control" value="{{ $student->middle_name }}">
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ $student->last_name }}">
        </div>

        <div class="mb-3">
            <label>Gender</label>
            <select name="gender_id" class="form-control">
                @foreach($genders as $gender)
                    <option value="{{ $gender->id }}" {{ $student->gender_id == $gender->id ? 'selected' : '' }}>
                        {{ $gender->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Course</label>
            <select name="course_id" class="form-control">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $student->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
