@extends('master')
@section('title', 'Vytvorit jednotku')

@section('content')
    <h1>Upravit jednotku</h1>
    <form action="{{ route('unit.update', $unit->id) }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Název</label>
            <input value="{{ $unit->name }}" id="name" name="name" type="text" class="form-control" placeholder="Název">
        </div>
        <div class="form-group">
            <label for="pattern">Vzorec</label>
            <input value="{{ $unit->pattern }}" name="pattern" id="pattern" type="text" placeholder="Vzorec" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Ulozit</button>
    </form>
    <br>
    Premenné vo vzorci
    <ul>
        <li>a - cena</li>
        <li>b - pocet jednotiek</li>
    </ul>
    <br>
    <a href="{{url()->previous()}}">Zrušiť akciu</a>
@endsection
