<x-app-layout>
<div class="content">
    <h3>Edit Score</h3>
    <form action="{{ route('scores.update',$score->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $score->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Subject</label>
            <select name="subject_id" class="form-control">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $score->subject_id == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Exam Type</label>
            <select name="exam_type_id" class="form-control">
                @foreach($examTypes as $examType)
                    <option value="{{ $examType->id }}" {{ $score->exam_type_id == $examType->id ? 'selected' : '' }}>
                        {{ $examType->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Score</label><input type="number" name="score" class="form-control" value="{{ $score->score }}"></div>
        <div class="mb-3"><label>Max Score</label><input type="number" name="max_score" class="form-control" value="{{ $score->max_score }}"></div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('scores.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
