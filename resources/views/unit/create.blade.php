@extends('master')
@section('title', 'Vytvorit jednotku')

@section('content')
    <h1>Vytvoriť jednotku</h1>
    <form action="{{ url('unit') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Název</label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Název">
        </div>
        <div class="form-group">
            <label for="pattern">Vzorec</label>
            <input name="pattern" id="pattern" type="text" placeholder="Vzorec" value="a * b" class="form-control">
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
