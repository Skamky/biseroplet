@extends('layouts.app')
@section('content')
    <div class="alert alert-info alert-dismissible " role="alert">
Здесь будут представлены примеры схемы созданные в генераторе..
    </div>
<h1>  10 последних созданных схем  </h1>
    <div class="mx-2 row row-cols-1 row-cols-md-2 g-4">

        <script class="temp">
            let htmlcode="";
        </script>

    @foreach($schemes as $scheme)
        <div class="col">
            <div class="card">
{{--                <img src="..." class="card-img-top" alt="">--}}
                <div class="accordion accordion-flush" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h5 class="card-title">{{$scheme->name_scheme}}</h5>                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="table-responsive">
                                    <table id="table{{$scheme->id_scheme}}" class="table-borderless   table-responsive ">
                                    </table>
                                </div>                            </div>
                        </div>
                    </div>
                </div>
                <div id="temp{{$scheme->id_scheme}}" class="temp">
                    {{$scheme->code_scheme}}
                </div>
                <script class="temp" >
                    htmlcode =$('#temp{{$scheme->id_scheme}}').text();
                    console.log('Проверка {{$scheme->id_scheme}}');
                    // console.log(htmlcode);
                    $('#table{{$scheme->id_scheme}}').append(htmlcode);
                </script>
                <div class="card-body">
{{--                    <h5 class="card-title">{{$scheme->name_scheme}}</h5>--}}
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

    <script class="temp" defer>
        scale(-5)

        $('.temp').remove()
    </script>

@endsection
