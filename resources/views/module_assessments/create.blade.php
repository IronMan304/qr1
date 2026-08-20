<x-app-layout>
<div class="content">
    <h3>Add Module Assessment</h3>
    <form action="{{ route('module_assessments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Module</label>
            <select name="module_id" class="form-control">
                @foreach($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3"><label>Weight</label><input type="number" step="0.01" name="weight" class="form-control"></div>
        <div class="mb-3"><label>Grade</label><input type="number" step="0.01" name="grade" class="form-control"></div>
        <div class="mb-3"><label>Points</label><input type="number" step="0.01" name="points" class="form-control"></div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('module_assessments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
