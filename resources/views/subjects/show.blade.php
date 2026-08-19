@extends('layouts.app')

@section('content')
<h1>{{ $subject->name }}</h1>
<p><strong>Code:</strong> {{ $subject->code }}</p>
<p><strong>Description:</strong> {{ $subject->description }}</p>
<a href="{{ route('subjects.index') }}">Back</a>
@endsection
