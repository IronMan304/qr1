<x-app-layout>
<div class="content">
    <h3>Edit Evaluation</h3>
    <form action="{{ route('evaluations.update',$evaluation->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3"><label>Student</label>
            <select name="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $evaluation->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Subject</label>
            <select name="subject_id" class="form-control">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $evaluation->subject_id == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Assessment Type</label>
            <select name="assessment_type_id" class="form-control">
                @foreach($assessmentTypes as $type)
                    <option value="{{ $type->id }}" {{ $evaluation->assessment_type_id == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Weight</label><input type="number" step="0.01" name="weight" class="form-control" value="{{ $evaluation->weight }}"></div>
        <div class="mb-3"><label>