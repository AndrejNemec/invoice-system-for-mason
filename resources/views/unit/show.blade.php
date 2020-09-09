@extends('master')
@section('title', 'Úprava položky')

@section('content')
    <div class="row">

        <h1>{{ $unit->name }}</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Vzorec</th>
                    <th>Akcia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ $unit->pattern }}
                    </td>
                    <td>
                        <a href="{{ route('unit.edit', $unit->id) }}" class="btn btn-primary btn-sm">Upravit</a>
                        |
                        <a onclick="deleteUnit(event, {{ $unit->id }})" href="{{ url('unit', $unit->id) }}"
                           class="btn btn-danger btn-sm">Vymazat</a>

                        <form id="unit-delete-form-{{ $unit->id }}" action="{{ url('unit', $unit->id) }}"
                              method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
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