@extends('master')
@section('title', 'Projekty')

@section('content')
    <div class="float-left">
        <h1>Jednotky</h1>
    </div>
    <div class="float-right">
        <a href="{{ route('unit.create') }}" class="btn btn-warning">Vytvorit</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Jednotka</th>
                <th>Vzorec</th>
                <th>Akcia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($units as $unit)
                <tr>
                    <td>
                        <a href="{{ route('unit.show', $unit->id) }}">{{ $unit->name }}</a>
                    </td>
                    <td>
                        {{ $unit->pattern }}
                    </td>
                    <td>
                        <a href="{{ route('unit.edit', $unit->id) }}" class="btn btn-primary btn-sm">Upravit</a>
                        |
                        <a onclick="deleteUnit(event, {{ $unit->id }})" href="{{ url('unit', $unit->id) }}"
                           class="btn btn-danger btn-sm">Smazat</a>

                        <form id="unit-delete-form-{{ $unit->id }}" action="{{ url('unit', $unit->id) }}"
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
        function deleteUnit(event, id) {
            event.preventDefault();
            if (!confirm('Fakt ?\n\n' +
                'POZOR! Táto zmena je nevratná!\n\n' +
                'Vymazaním tejto jednotky sa vymažú\n' +
                'aj všetky položky ktoré patria pod tuto jednotku!\n\n' +
                '(Jednotku možeš upravit)')) return;

            document.getElementById('unit-delete-form-' + id).submit();
        }
    </script>
@endsection
