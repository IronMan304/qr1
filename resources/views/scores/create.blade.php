<x-app-layout>
<div class="content">
    <h3>Add Score</h3>
    <form action="{{ route('scores.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Subject</label>
            <select name="subject_id" class="form-control">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Exam Type</label>
            <select name="exam_type_id" class="form-control">
                @foreach($examTypes as $examType)
                    <option value="{{ $examType->id }}">{{ $examType->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Score</label><input type="number" name="score" class="form-control"></div>
        <div class="mb-3"><label>Max Score</label><input type="number" name="max_score" class="form-control"></div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('scores.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
