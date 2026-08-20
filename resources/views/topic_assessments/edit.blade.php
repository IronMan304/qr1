<x-app-layout>
<div class="content">
    <h3>Edit Topic Assessment</h3>
    <form action="{{ route('topic_assessments.update',$topicAssessment->id) }}" method="POST">
        @csrf 
        @method('PUT')

        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->id }}" 
                        {{ $topicAssessment->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Subject</label>
            <select name="subject_id" class="form-control">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" 
                        {{ $topicAssessment->subject_id == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Weight</label>
            <input type="number" step="0.01" name="weight" class="form-control" 
                   value="{{ $topicAssessment->weight }}">
        </div>

        <div class="mb-3">
            <label>Grade</label>
            <input type="number" step="0.01" name="grade" class="form-control" 
                   value="{{ $topicAssessment->grade }}">
        </div>

        <div class="mb-3">
            <label>Points</label>
            <input type="number" step="0.01" name="points" class="form-control" 
                   value="{{ $topicAssessment->points }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('topic_assessments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
