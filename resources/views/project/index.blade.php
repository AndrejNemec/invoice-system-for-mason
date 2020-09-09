@extends('master')
@section('title', 'Projekty')

@section('content')
    <div class="float-left">
        <h1>Projekty</h1>
    </div>
    <div class="float-right">
        <a href="{{ route('project.create') }}" class="btn btn-warning">Vytvorit</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Názov</th>
                <th>Akcia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>
                        <a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a>
                    </td>
                    <td>
                        <a href="{{ route('project.edit', $project->id) }}" class="btn btn-primary btn-sm">Upravit</a>
                        <a href="{{ route('project.destroy', $project->id) }}" onclick="deleteProject(event, {{ $project->id }});" class="btn btn-danger btn-sm">Smazat</a>
                        <form id="project-delete-{{ $project->id }}" action="{{ route('project.destroy', $project->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')

    <script>
        function deleteProject(event, id) {
            event.preventDefault();
            if (!confirm('Fakt ?')) return;
            document.getElementById('project-delete-' + id).submit();
        }
    </script>

@endsection
