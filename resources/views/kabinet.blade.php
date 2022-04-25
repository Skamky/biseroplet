@extends('layouts.app')
@section('content')
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
                                <a href="/delete/{{$scheme->id_scheme}}" class="btn btn-outline-danger" title="Удалить схему">🗑</a>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Обновлено: {{$scheme->updated_at}}</small>
                        </div>
                    </div>
                </div>
    @endforeach
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
