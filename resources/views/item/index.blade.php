@extends('master')
@section('title', 'Úprava položky')

@section('content')
    <div class="float-left">
        <h1>Celý zoznam položek</h1>
    </div>
    <div class="float-right">
        <a href="{{route('item.create')}}" class="btn btn-warning">Vytvorit</a>
    </div>
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
            @foreach($items as $item)
                <tr>
                    <td>
                        <a href="{{route('item.show', $item->id)}}">{{ $item->name }}</a>
                    </td>
                    <td>
                        {{ $item->price.'€/'.$item->unit->name }}
                    </td>
                    <td>
                        {{ $item->catalog->name }}
                    </td>
                    <td>
                        <a href="{{ route('item.edit', $item->id) }}" class="btn btn-primary btn-sm">
                            Upravit
                        </a>
                        <a onclick="deleteItem(event, {{ $item->id }})" class="btn btn-danger btn-sm">Smazat</a>
                        <form id="item-delete-form-{{ $item->id }}" href="{{ route('item.destroy', $item->id) }}" action="{{ route('item.destroy', $item->id)  }}"
                              method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $items->links() !!}
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