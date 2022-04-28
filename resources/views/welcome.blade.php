@extends('layouts.app')
@section('content')
    <div class="alert alert-info alert-dismissible " role="alert">
Здесь будут представлены примеры схемы созданные в генераторе..
    </div>
<h1>  10 последних созданных схем  </h1>
    <div class="mx-2 row row-cols-1 row-cols-md-2 g-4">

    @foreach($schemes as $scheme)
        <div class="col">
            <div class="card">
                <img src="..." class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{$scheme->name_scheme}}</h5>
                    <p class="card-text">{{$scheme->description_scheme }}</p>
                    <p class="card-text">Автор: {{$scheme->login }}</p>
                        <a href="/profile/{{$scheme->login}}/{{$scheme->id_scheme}}" class="btn btn-primary">Открыть схему</a>
                        {{--                                <a href="/delete/{{$scheme->id_scheme}}" class="btn btn-outline-danger" title="Удалить схему">🗑</a>--}}


                </div>
                <div class="card-footer">
                    <small class="text-muted">Обновлено: {{$scheme->updated_at}}</small>
                    <br>
                    <small class="text-muted">Создано: {{$scheme->created_at}}</small>

                </div>
            </div>
        </div>
    @endforeach
    </div>

@endsection
