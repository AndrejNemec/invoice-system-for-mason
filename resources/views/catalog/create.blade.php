@extends('master')
@section('title', 'Vytvorit cennik')

@section('content')
    <h1>Vytvorit nový cenník</h1>
    <form method="POST" action="{{ url('catalog') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Název</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Název">
                <br>
                <button type="submit" class="btn btn-success">Uložit</button>
            </div>
        </div>
    </form>
    <a href="{{url()->previous()}}">Zrušiť akciu</a>
@endsection