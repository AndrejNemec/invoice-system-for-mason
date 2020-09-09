@extends('master')
@section('title', 'Upravit projekt')

@section('content')

    <h1>Upravit projekt</h1>

    <form action="{{ route('project.update', $project->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Názov</label>
            <input value="{{ $project->name }}" type="text" id="name" name="name" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Uložit</button>
    </form>

@endsection
