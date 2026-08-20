<x-app-layout>
<div class="content">
    <h3>Add Evaluation</h3>
    <form action="{{ route('evaluations.store') }}" method="POST">
        @csrf
        <div class="mb-3"><label>Student</label>
            <select name="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Subject</label>
            <select name="subject_id" class="form-control">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Assessment Type</label>
            <select name="assessment_type_id" class="form-control">
                @foreach($assessmentTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Weight</label><input type="number" step="0.01" name="weight" class="form-control"></div>
        <div class="mb-3"><label>Grade</label><input type="number" step="0.01" name="grade" class="form-control"></div>
        <div class="mb-3"><label>Points</label><input type="number" step="0.01" name="points" class="form-control"></div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
