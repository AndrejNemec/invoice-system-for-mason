@extends('master')
@section('title', $catalog->name)

@section('content')
    <div class="float-left">
        <h1>{{ $catalog->name }}</h1>
    </div>
    <div class="float-right">
        <a href="{{ route('item.create').'?catalog='.$catalog->id }}" class="btn btn-warning">
            Vytvorit
        </a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Název</th>
                <th>Jednotka</th>
                <th>Cena</th>
                <th>Akcia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($catalog->items as $item)
                <tr>
                    <td>
                        {{ $item->name }}
                    </td>
                    <td>
                        {{ $item->unit->name }}
                    </td>
                    <td>
                        {{ $item->price }}€
                    </td>
                    <td>
                        <a href="{{ route('item.edit', $item->id) }}" class="btn btn-primary btn-sm">
                            Upravit
                        </a>
                        <a href="{{ route('item.destroy', $item->id) }}" onclick="deleteItem(event, {{ $item->id }})" class="btn btn-danger btn-sm">Smazat</a>
                        <form id="item-delete-form-{{ $item->id }}" action="{{ route('item.destroy', $item->id)  }}"
                              method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script>
        function deleteItem(event, id) {
            event.preventDefault();
            if (!confirm('Fakt ?\n\n' +
                'POZOR! Táto zmena je nevratná!\n\n' +
                '(Položku možeš upravit)')) return;

            document.getElementById('item-delete-form-' + id).submit();
        }
    </script>
@endsection