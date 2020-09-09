@extends('master')
@section('title', $item->name)

@section('content')
    <h1>Položka: {{ $item->name }}</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Název</th>
                <th>Cena</th>
                <th>Cenník</th>
                <th>Akcia</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ $item->name }}
                </td>
                <td>
                    {{ $item->price.'€/'.$item->unit->name }}
                </td>
                <td>
                    <a href="{{ route('catalog.show', $item->catalog->id) }}">{{ $item->catalog->name }}</a>
                </td>
                <td>
                    <a href="{{ route('item.edit', $item->id) }}" class="btn btn-primary btn-sm">
                        Upravit
                    </a>
                    <a onclick="deleteItem(event, {{ $item->id }})" class="btn btn-danger btn-sm">Smazat</a>
                    <form id="item-delete-form-{{ $item->id }}" href="{{route('item.destroy', $item->id)}}" action="{{ route('item.destroy', $item->id)  }}"
                          method="POST">
                        @method('DELETE')
                        @csrf
                    </form>
                </td>
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