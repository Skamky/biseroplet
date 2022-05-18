@extends('layouts.app')
@section('content')
@include('components.SerachBar')
<hr>
{{ $schemes->links() }}

<div class="mx-2 row row-cols-1 row-cols-md-2 g-4">
    <script class="temp">
        let htmlcode="";
    </script>
    @foreach($schemes as $scheme)
        @include('components.cardScheme')
    @endforeach
    </div>
{{ $schemes->links() }}

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
