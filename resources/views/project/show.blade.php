@extends('master')
@section('title', 'Projekty')

@section('content')
    <h1>{{ $project->name }}</h1>

    <div class="row">
        <div class="col-lg-3">
            <div id="catalogs">
                @foreach($catalogs as $catalog)
                    <div class="card">
                        <div class="card-header" id="heading-{{ $catalog->id }}">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse"
                                        data-target="#collapse-{{$catalog->id}}"
                                        aria-expanded="false" aria-controls="collapse-{{ $catalog->id }}">
                                    {{ $catalog->name }}
                                </button>
                            </h5>
                        </div>

                        <div id="collapse-{{ $catalog->id }}" class="collapse hide"
                             aria-labelledby="heading-{{ $catalog->id }}"
                             data-parent="#catalogs">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Položka</th>
                                            <th>Akcia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($catalog->items as $item)
                                            @if (!checkItem($project->projectItems, $item))
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        <form action="{{ route('project.items.add', $project->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" value="{{ $project->id }}"
                                                                   name="project_id">
                                                            <input type="hidden" value="{{ $item->id }}" name="item_id">
                                                            <input class="form-control" type="number" step='any'
                                                                   value="1" name="count"><br>
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                <i class="fa fa-plus"></i> Pridať
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="col-lg-9">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link {{$type == '1' ? 'active' : ''}}"
                       href="{{ route('project.type', ['id' => $project->id, 'type' => '1']) }}">Všetko</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$type == '2' ? 'active' : ''}}"
                       href="{{ route('project.type', ['id' => $project->id, 'type' => '2']) }}">Skupiny</a>
                </li>
            </ul>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            Položka
                        </th>
                        <th>
                            Vzorec
                        </th>
                        <th>
                            Jednotky
                        </th>
                        <th>
                            Cena
                        </th>
                        <th>
                            Akcia
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($type == 2)
                        @foreach($project->groups as $group => $value)
                            @if (is_array($value))
                                <tr class="table-warning">
                                    <td><b>{{$group}}</b></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <b>{{ sprintf('%.2f', round($value['total_price'], 2)) }} €</b>
                                    </td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                    @elseif($type == 1)



                        @foreach($project->groupItems as $group => $value)
                            @if (is_array($value))
                                <tr class="table-warning">
                                    <td><b>{{$group}}</b></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>{{sprintf('%.2f', round($value['total_price'], 2)) }} €</b></td>
                                    <td></td>
                                </tr>

                                @foreach($value as $itemKey => $itemValue)
                                    @if (isset($itemValue['item']))
                                        <tr>
                                            <td>{{$itemValue['item']['name']}}</td>
                                            <td>{{$itemValue['pattern']}}</td>
                                            <td>
                                                <form id="save-form-{{$itemValue['id']}}"
                                                      action="{{ route('project.items.update', $itemValue['id']) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="project_id"
                                                           value="{{ $itemValue['project_id'] }}">
                                                    <input type="hidden" name="item_id"
                                                           value="{{ $itemValue['item']['id'] }}">
                                                    <input onclick="edit({{ $itemValue['id'].', '.$itemValue['count'] }})"
                                                           id="item-edit-{{ $itemValue['id'] }}"
                                                           name='count'
                                                           class="form-control col-sm-8" type="number" step="any"
                                                           value="{{$itemValue['count']}}" readonly
                                                           style="background-color: #dadada;">
                                                </form>

                                            </td>
                                            <td>{{sprintf('%.2f', round($itemValue['price'], 2)) }} €</td>
                                            <td>
                                                <form action="{{ route('project.items.remove', $itemValue['id']) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="confirm('Fakt chces vymazat tuto položku?') ? '' : event.preventDefault(); return;"
                                                            class="btn btn-danger btn-sm">Vymazať
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach


                    @endif
                    <tr class="table-primary">
                        <td><b>Celková cena:</b></td>
                        <td></td>
                        <td></td>
                        <td><b>{{sprintf('%.2f', round($project->groups['full_price'], 2))}} €</b></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <button href="{{ route('project.type.invoice', ['id' => $project->id, 'type' => $type]) }}"
                    type="button" class="btn btn-primary" data-toggle="modal" data-target="#print-invoice">
                Vytlačiť faktúru
            </button>

        </div>
    </div>

    <div class="modal fade" id="edit-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upraviť počet</h5>
                    <button onclick="reset()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="number" step="any" id="unit-edit">
                </div>
                <div class="modal-footer">
                    <button onclick="reset()" type="button" class="btn btn-secondary" data-dismiss="modal">Zatvoriť
                    </button>
                    <button onclick="saveItem(event)" type="button" class="btn btn-primary">Uložiť zmeny</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="print-invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('project.type.invoice', ['id' => $project->id, 'type' => $type]) }}"
                      method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Vytlačiť fakturu</h5>
                        <button onclick="reset()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="invoice-number">Číslo faktúry</label><br>
                            <input id="invoice-number" name="invoice_number" type="text" value="{{ $project->invoice_number }}"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="purchaser">Odberateľ</label><br>
                            <textarea class="form-control" name="purchaser" id="purchaser" cols="30" rows="10">{{ $project->purchaser }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="date-of-issue">Dátum vystavenia</label><br>
                            <input id="date-of-issue" type="date" name="date_of_issue" class="form-control"
                                   value="{{ $project->date_of_issue }}">
                        </div>

                        <div class="form-group">
                            <label for="due_date">Dátum splatnosti</label><br>
                            <input type="date" id="due_date" name="due_date" class="form-control"
                                   value="{{ $project->due_date }}">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvoriť
                        </button>
                        <button type="submit" class="btn btn-primary">Uložiť zmeny a
                            vytlačiť
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
@section('js')

    <script>

        var editId = -1;

        function edit(id, count) {
            editId = id;
            $('#unit-edit').val(count);
            $('#edit-form').modal('show');
        }

        function saveItem(event) {
            event.preventDefault();
            if (editId === -1) return;
            $('#item-edit-' + editId).val($('#unit-edit').val());
            $.post({
                url: $('#save-form-' + editId).attr('action'),
                data: $('#save-form-' + editId).serialize(),

                success: function (data) {
                    location.reload();
                }
            });
        }

        function reset() {
            editId = -1;
            $('#unit-edit').val(0);
        }

    </script>

@endsection
