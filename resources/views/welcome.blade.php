@extends('layouts.app')
@section('content')
    <script class="temp">
        let htmlcode="";
    </script>
    <h1>О сайте</h1>
    <hr>
    <h5 class="font-weight-normal">В плетении бисером остро стоит вопрос по созданию схем для плетения, так как такие схемы обычно рисуются вручную с помощью канцтоваров, либо с помощью шаблона, созданных в графических редакторах, что занимает большое количество времени и требует определённого навыка в рисовании, а в последствии не позволяет быстро отредактировать или создать из уже имеющиеся схемы - новую схему.
        Данный веб сайт позволит упростить и частично автоматизировать процесс создания и редактирования таких схем.
    </h5>
    <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('favicon.ico')}}" class="rounded mx-auto  d-block  img-thumbnail  img-fluid " alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('vino.jpg')}}" class="rounded mx-auto  d-block  img-thumbnail  img-fluid min-vh-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('favicon.ico')}}" class="rounded mx-auto  d-block img-thumbnail  img-fluid" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<h1>  10 последних созданных схем  </h1>
    <hr>
{{--    <div class="container">--}}

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($schemes as $scheme)
            @include('components.cardScheme')
        @endforeach
        </div>
{{--    </div>--}}
    <a href="/search/last">Больше схем</a>
    <script async>


        function like(schemaId,value,thisIdElem,idContainer) {
            thisIdElem=$(thisIdElem);
            $(idContainer).html('<button class="btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>🥱 Пожалуйста подождите...</button>')

            console.log(thisIdElem);
            let url;
            if (thisIdElem.hasClass('active'))
                url='{{route('ajax')}}/'+schemaId+'/0';
            else
                url='{{route('ajax')}}/'+schemaId+'/'+value;
           // $.get(url,myCallback)
            $(idContainer).load(url);
        }
    </script>
    <script class="temp" defer>
        document.addEventListener("DOMContentLoaded", () => {
            scale(-5)
            $('.temp').remove()
        });
    </script>
<style>
    @foreach($schemes as $scheme)
        @foreach($scheme->color_scheme as $color )
            .id{{$scheme->id_scheme}}color{{$loop->iteration}}{background-color:#{{$color}};}
        @endforeach
    @endforeach
</style>
@endsection
