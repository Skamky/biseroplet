@extends('layouts.app')
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning ">
                    <h5 class="modal-title" id="exampleModalLabel">Подтверждение</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="pDeleteElem">Удалить?</p>
                    <p id="pDeleteElem_data" class="text-black-50">(Обновлено:    hgkj hi  )</p>
                    <p class="text-danger"><small>В случае удаления схемы её невозможно будет восстановить!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <a id="linkdelete" class="btn btn-danger" href="#">Удалить</a>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->name==$ProfileName)
            <div class="mx-2 row row-cols-1 row-cols-md-2 g-4">

            @foreach($schemes as $scheme)
                <div class="col">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{$scheme->name_scheme}}</h5>
                            <p class="card-text">{{$scheme->description_scheme }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="/profile/{{$ProfileName}}/{{$scheme->id_scheme}}" class="btn btn-primary">Открыть схему</a>
{{--                                <a href="/delete/{{$scheme->id_scheme}}" class="btn btn-outline-danger" title="Удалить схему">🗑</a>--}}
                                <button type="button" class="btn btn-outline-danger" onclick="pasteValue('{{$scheme->name_scheme}}',{{$scheme->id_scheme}},'{{$scheme->updated_at}}')" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    🗑
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Обновлено: {{$scheme->updated_at}}</small>
                        </div>
                    </div>
                </div>
    @endforeach
                <script>
                    function pasteValue (label,id,updateDate)
                    {
                        console.log('начало')
                        $("#pDeleteElem").text("Удалить "+label+" ?");
                        $("#pDeleteElem_data").text("Обновлено: "+updateDate);
                        let newhref="/delete/"+String(id);
                        $("#linkdelete").attr("href",newhref);
                        console.log(newhref);
                    }
                </script>
    @else
                    <div class="alert alert-warning alert-dismissible " role="alert">
                        Вы просматриваете профиль {{$ProfileName}}
                    </div>
                    <div class="mx-2 row row-cols-1 row-cols-md-2 g-4">

                    @foreach($schemes as $scheme)
                <div class="col">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{$scheme->name_scheme}}</h5>
                            <p class="card-text">{{$scheme->description_scheme }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="/profile/{{$ProfileName}}/{{$scheme->id_scheme}}" class="btn btn-primary">Открыть схему</a>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Обновлено: {{$scheme->updated_at}}</small>
                        </div>
                    </div>
                </div>
    @endforeach
    @endif

                    </div>







@endsection
