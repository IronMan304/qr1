<x-app-layout>
<div class="content">
    <h3>Edit Assessment Type</h3>
    <form action="{{ route('assessment_types.update',$assessmentType->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3"><label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $assessmentType->name }}">
        </div>
        <div class="mb-3"><label>Domain</label>
            <select name="domain_id" class="form-control">
                @foreach($domains as $domain)
                    <option value="{{ $domain->id }}" {{ $assessmentType->domain_id == $domain->id ? 'selected' : '' }}>
                        {{ $domain->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Weight</label>
            <input type="number" step="0.01" name="weight" class="form-control" value="{{ $assessmentType->weight }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('assessment_types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
