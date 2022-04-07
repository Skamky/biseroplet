@extends('layouts.app')

@section('content')
{{--Панель инструментов--}}
<div>
<h5>Инструменты</h5>
    <div id="div Tools" class="btn-group btn-group-lg" role="group">
        <button class="btn btn-outline-secondary" onclick="scale(1)">+</button>
        <button class="btn btn-outline-secondary" onclick="scale(-1)">-</button>

    </div>
</div>
@auth
<div>
    <h5>Сохранение схемы</h5>
    <button onclick="ReadTable()"> Заполнить поля</button>

    <form action="/save" method="post">

        <input name="name_scheme" required placeholder="Название схемы">
        <input name="description_scheme" placeholder="описание схемы">
        <input name="color_scheme" id="color_scheme" required placeholder="цвета используемые в схеме">
        <input name="code_scheme" id="code_scheme" type="hidden"  required placeholder="код схемы">

        <input type="submit">
    </form>
</div>
@endauth

<div class="rounted shadow bottom-0 end-0 h-50  card position-fixed ">
<h5 class="card-card-header"> Палитра</h5>

    <div class="card-body overflow-auto " id="divPalitra">
        Добавить новый цвет <button onclick="addColor()">➕</button>
        <br>
        Удалить эллемент <button id="btndelete"  >❌</button>
        <hr>
        Первичный цвет:<input type="color" id="color1" class="rounded inputColor selectColor" value="{{$color}}" onclick="selectPalitra(1)" onchange="changeColor(1)">
    </div>
</div>
{{--табличка--}}
<div class="table-responsive">
<table class="table-borderless   table-responsive ">
@if($newScheme)
    <thead>
    <tr>
        <th scope="col">#</th>
        @for ($i = 1; $i <= $w; $i++)
        <th scope="col"></th>
        <th scope="col">{{$i}}</th>
        @endfor
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row"></th>
        @for ($i = 0; $i < $w; $i++)
        <td></td>
        <td><div class="ovalVert transformScale color1"></div> </td>
        @endfor
    </tr>
    @for ($s = 1; $s <= $h; $s++)
    <tr>
        <th scope="row">{{$s}}&nbsp</th>
        @for ($i = 1; $i <= $w+1; $i++)
        <td><div class="ovalHoriz  color1"></div> </td>
        <td></td>
        @endfor
    </tr>
    <tr>
        <th scope="row"></th>
        @for ($i = 0; $i < $w; $i++)
            <td></td>
            <td><div class="ovalVert color1"></div> </td>
        @endfor
        @endfor
    </tr>
    </tbody>
    @else

    @endif
</table>
</div>

<script>
    function ReadTable()
    {
        let colors="";
        console.log($('table').html())

        console.log("цвета");
            $('.inputColor').each(function( index )
            {
                colors+=$( this ).val();
            console.log( index + ": " + $( this ).val());

            });
            console.log(colors);
            $('#code_scheme').val($('table').html());
            $('#color_scheme').val(colors);
    }
    //покраска эллемента
    $( ".ovalHoriz,.ovalVert" ).click(
        function( event )
        {
            if($("#btndelete").hasClass('selectColor'))
            {
                $(this).css('opacity',0 )
            }
            else
            {
                let color = $(".selectColor").prop("id");
                console.log(color);

                if ($(this).hasClass("ovalVert"))
                {
                    $(this).removeClass().addClass( "ovalVert "+color);
                }
                else
                {
                    $(this).removeClass().addClass( "ovalHoriz "+color);
                }
                //$(this).css('background', color);
                $(this).css('opacity',1)
            }
            // console.log( $(this).prop('className'));
            // $(this).addClass('active');
            // console.log( $(this).prop('className'));
        }
    );
    //выбор палитры
    $( "#btndelete" ).click(
        function selectPalitra ( event )
        {
            console.log("select")
            $( "[type='color'],#btndelete").removeClass('selectColor')
            console.log( $(this));
             $(this).addClass('selectColor');
            // console.log( $(this).prop('className'));
            // console.log( $(this).val());
        }
    );
    //изменение цвета в зависимости от выбранной палтры
</script>

<style id="stPalitra">
    .color1{background-color:{{$color}};}
</style>
<style id="stTransform"> </style>

@endsection
