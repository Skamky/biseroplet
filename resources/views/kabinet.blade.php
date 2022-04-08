@extends('layouts.app')
@section('content')
    <div class="mx-2 row row-cols-1 row-cols-md-2 g-4">
        @foreach($schemes as $scheme)
        <div class="col">
            <div class="card">
                <img src="..." class="card-img-top" alt="*тут должна быть картинка ваше схемы*">
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




{{--        <div class="col">--}}
{{--            <div class="card">--}}
{{--                <img src="..." class="card-img-top" alt="...">--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title">Card title</h5>--}}
{{--                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                    <small class="text-muted">Last updated 3 mins ago</small>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col">--}}
{{--            <div class="card">--}}
{{--                <img src="..." class="card-img-top" alt="...">--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title">Card title</h5>--}}
{{--                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                    <small class="text-muted">Last updated 3 mins ago</small>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col">--}}
{{--            <div class="card">--}}
{{--                <img src="..." class="card-img-top" alt="...">--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title">Card title</h5>--}}
{{--                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                    <small class="text-muted">Last updated 3 mins ago</small>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection
