@extends('master')
@section('title', 'Vytvorit projekt')

@section('content')

    <h1>Vytvorit projekt</h1>

    <form action="{{ route('project.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Názov</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Uložit</button>
    </form>

@endsection
