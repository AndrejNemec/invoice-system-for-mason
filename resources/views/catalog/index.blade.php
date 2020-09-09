@extends('master')
@section('title', 'Cenník')

@section('content')
    <div class="float-left">
        <h1>Cenník</h1>
    </div>
    <div class="float-right">
        <a href="{{ url('catalog/create') }}" class="btn btn-warning">Vytvorit</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Název</th>
                <th>Akcia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($catalogs as $catalog)
                <tr>
                    <td><a href="{{ route('catalog.show', $catalog->id) }}"> {{ $catalog->name }}</a></td>
                    <td>
                        <a href="{{ route('catalog.edit', $catalog->id) }}" class="btn btn-primary btn-sm">Upravit</a>
                        |
                        <a onclick="deleteCatalog(event, {{ $catalog->id }})"
                           href="{{ url('catalog', $catalog->id) }}"
                           class="btn btn-danger btn-sm">Vymazat</a>
                        <form id="catalog-delete-form-{{ $catalog->id }}" action="{{ url('catalog', $catalog->id) }}"
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
        function deleteCatalog(event, id) {
            event.preventDefault();
            if (!confirm('Fakt ?\n\n' +
                'POZOR! Táto zmena je nevratná!\n\n' +
                'Vymazaním tohto cenníku sa vymažú\n' +
                'aj všetky položky ktoré patria pod tento cenník!\n\n' +
                '(Cenník možeš upravit)')) return;
            document.getElementById('catalog-delete-form-' + id).submit();
        }
    </script>
@endsection
