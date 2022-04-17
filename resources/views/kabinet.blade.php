@extends('layouts.app')
@section('content')
    <div class="mx-2 row row-cols-1 row-cols-md-2 g-4">
        @foreach($schemes as $scheme)
        <div class="col">
            <div class="card">
                <img src="..." class="card-img-top" alt="*тут должна быть картинка вашей схемы*">
                <div class="card-body">
                    <h5 class="card-title">{{$scheme->name_scheme}}</h5>
                    <p class="card-text">{{$scheme->description_scheme }}</p>
                    <a href="/profile/{{Auth::user()->name}}/{{$scheme->id_scheme}}" class="btn btn-primary">Открыть схему</a>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Обновлено: {{$scheme->updated_at}}</small>
                </div>
            </div>
        </div>
        @endforeach






@endsection
