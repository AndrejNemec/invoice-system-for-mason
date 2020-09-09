@extends('master')
@section('title', 'Nová položka')
@section('content')
    <h1>@yield('title')</h1>
    <form method="POST" action="{{route('item.store')}}">
        @csrf
        <div class="form-group">
            <label for="name">Název</label>
            <input type="text" value="{{(isset($item->name) ? $item->name : '')}}" class="form-control" name="name"
                   id="name" placeholder="Název">
        </div>

        <div class="form-group">
            <label for="price">Cena</label>
            <input type="number" value="{{(isset($item->price) ? $item->price : '')}}" class="form-control" step="any"
                   name="price" id="price"
                   placeholder="Cena">

        </div>

        <div class="form-group">
            <label for="units">Jednotka</label>
            <select name="unit_id" class="form-control" id="units">
                @foreach($units as $unit)
                    @if($unit->id === (isset($item->unit->id) ? $item->unit->id : '-1'))
                        <option class="text-success" selected value="{{$unit->id}}">{{$unit->name}}</option>
                    @else
                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="catalog">Cenník</label>
            <select name="catalog_id" class="form-control" id="catalog">
                @foreach($catalogs as $catalog)
                    @if($catalog->id === (isset($item->catalog->id) ? $item->catalog->id : ((int)app('request')->input('catalog'))))
                        <option class="text-success" selected value="{{ $catalog->id }}">{{$catalog->name}}</option>
                    @else
                        <option value="{{ $catalog->id }}">{{$catalog->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Uložit</button>
        </div>
    </form>
    <a href="{{url()->previous()}}">Zrušiť akciu</a>
@endsection