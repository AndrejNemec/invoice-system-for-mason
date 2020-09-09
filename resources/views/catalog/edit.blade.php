@extends('master')
@section('title', 'Upravit cennik')

@section('content')
    <h1>Upravit cenník</h1>
    <form method="POST" action="{{ route('catalog.update', $catalog->id) }}">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Název</label>
                <input type="text" value="{{ $catalog->name }}" class="form-control" name="name" id="name" placeholder="Název">
                <br>
                <button type="submit" class="btn btn-success">Uložit</button>
            </div>
        </div>
    </form>
    <a href="{{url()->previous()}}">Zrušiť akciu</a>
@endsection