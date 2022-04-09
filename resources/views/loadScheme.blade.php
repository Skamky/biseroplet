@extends('layouts.app')

@section('content')
    {{--Панель инструментов--}}
    <div>
        <h5>Инструменты</h5>
        <div id="div Tools" class="btn-group btn-group-lg" role="group">
            <button class="btn btn-outline-secondary" onclick="scale(1)">+</button>
            <button class="btn btn-outline-secondary" onclick="scale(-1)">-</button>
            <button class="btn btn-primary" onclick="printSchema()">Экспорт</button>

        </div>
    </div>
    @auth
        <div>
            <h5>Сохранение схемы</h5>
{{--            <button onclick="ReadTable()"> Заполнить поля</button>--}}

            <form action="/save" method="post">
                <input name="id_scheme" value="{{$schemeId}}">
                <input name="name_scheme" value="{{$scheme->name_scheme}}" required placeholder="Название схемы">
                <input name="description_scheme" value="{{$scheme->description_scheme}}" placeholder="описание схемы">
                <input name="color_scheme"  id="color_scheme" required placeholder="цвета используемые в схеме">
                <input name="code_scheme"   id="code_scheme" type="hidden"  required placeholder="код схемы">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="newScheme" id="flexSwitchCheckChecked" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Перезаписать эту схему</label>
                </div>

                <input type="submit" onmouseover="ReadTable()">
            </form>
        </div>
    @endauth

    <div class="rounted shadow bottom-0 end-0 h-50  card position-fixed ">
        <h5 class="card-card-header"> Палитра</h5>

        <div class="card-body overflow-auto " id="divPalitra">
            Добавить новый цвет <button onclick="addColor()">➕</button>
            <br>
            Удалить эллемент <button id="btndelete"  >❌</button>
            @foreach($colors as $color)
            <hr>
             Цвет {{$loop->iteration}}:<input type="color" id="color{{$loop->iteration}}" class="inputColor form-control form-control-color selectColor" value="#{{$color}}" onclick="selectPalitra({{$loop->iteration}})" onchange="changeColor({{$loop->iteration}})">
            @endforeach
        </div>
    </div>
    {{--табличка--}}
    <div id="table_for_print">

    <div class="table-responsive">
        <table class="table-borderless   table-responsive ">
        </table>
    </div>
    </div>
    <div id="temp" class="temp">
        {{$scheme->code_scheme}}
    </div>
<script class="temp">
    let htmlcode =$('#temp').text();
    console.log('Проверка');
    console.log(htmlcode);
    $('table').append(htmlcode);
    $('.temp').remove()
</script>
    <script>

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
    <div id="divStyles">

    <style id="stPalitra">
        @foreach($colors as $color )
        .color{{$loop->iteration}}{background-color:#{{$color}};}
        @endforeach
    </style>
    <style id="stTransform"> </style>
    </div>

@endsection