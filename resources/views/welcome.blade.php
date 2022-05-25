@extends('layouts.app')
@section('content')

    <h1>О сайте</h1>
    <h5 class="font-weight-normal">В плетении бисером остро стоит вопрос по созданию схем для плетения, так как такие схемы обычно рисуются вручную с помощью канцтоваров, либо с помощью шаблона, созданных в графических редакторах, что занимает большое количество времени и требует определённого навыка в рисовании, а в последствии не позволяет быстро отредактировать или создать из уже имеющиеся схемы - новую схему.
        Данный веб сайт позволит упростить и частично автоматизировать процесс создания и редактирования таких схем.
    </h5>
<h1>  10 последних созданных схем  </h1>
    <div class="mx-2 row row-cols-1 row-cols-md-2 g-4">

        <script class="temp">
            let htmlcode="";
        </script>

    @foreach($schemes as $scheme)
        @include('components.cardScheme')
    @endforeach
    </div>

    <a href="/search/last">Больше схем</a>
    <script>

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

        function myCallback( returnedData ) {

            console.log(returnedData)

        }
    </script>
    <script class="temp" defer>
        scale(-5)
        $('.temp').remove()
    </script>
<style>
    @foreach($schemes as $scheme)
        @foreach($scheme->color_scheme as $color )
            .id{{$scheme->id_scheme}}color{{$loop->iteration}}{background-color:#{{$color}};}
        @endforeach
    @endforeach
</style>
@endsection
