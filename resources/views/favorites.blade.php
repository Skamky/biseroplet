@extends('layouts.app')
@section('content')
<h1>Избранные</h1>
<hr>
<div class="mx-2 row row-cols-1 row-cols-md-2 g-4">
    <script class="temp">
        let htmlcode="";
    </script>
    @foreach($schemes as $scheme)
        @include('components.cardScheme')
    @endforeach
</div>
<nav class="my-3">
    {{ $schemes->links() }}
</nav>

<script class="temp" defer>
    document.addEventListener("DOMContentLoaded", () => {
        scale(-5)
        $('.temp').remove()
    });
</script>

<script defer>
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

<style>
    @foreach($schemes as $scheme)
        @foreach($scheme->color_scheme as $color )
            .id{{$scheme->id_scheme}}color{{$loop->iteration}}{background-color:#{{$color}};}
    @endforeach
    @endforeach
</style>
@endsection
