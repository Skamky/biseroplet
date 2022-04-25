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
                <input name="id_scheme" type="hidden" value="{{$schemeId}}">
                <input name="name_scheme" maxlength="250" value="{{$scheme->name_scheme}}" required placeholder="Название схемы">
                <input name="description_scheme" maxlength="2500" value="{{$scheme->description_scheme}}" placeholder="описание схемы">
                <input name="color_scheme" type="hidden" id="color_scheme" required placeholder="цвета используемые в схеме">
                <input name="code_scheme"   id="code_scheme" type="hidden"  required placeholder="код схемы">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="newScheme" id="flexSwitchCheckChecked" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Перезаписать эту схему</label>
                </div>

                <input type="submit" onmouseover="ReadTable()">
                @csrf
            </form>
        </div>
    @endauth

    <div  id="divFullPalitra" class="rounted shadow bottom-0 end-0 mx-1 card position-fixed h-50">
        <h5 class="card-card-header p-2 stroke" onclick="hideShowPalitra()">Палитра</h5>

        <div class="card-body overflow-auto " id="divPalitra">
            Добавить новый цвет <button onclick="addColor()">➕</button>
            <br>
            Удалить элемент <button id="btndelete" class="selectColor" >❌</button>
            @foreach($colors as $color)
            <hr>
{{--             Цвет {{$loop->iteration}}:<input type="color" id="color{{$loop->iteration}}" class="inputColor form-control form-control-color selectColor" value="#{{$color}}" onclick="selectPalitra({{$loop->iteration}})" onchange="changeColor({{$loop->iteration}})">--}}
                <article id="color{{$loop->iteration}}" class=" d-flex justify-content-between align-items-center">
                    Цвет {{$loop->iteration}}:
                    <button type="button" onclick="selectPalitra({{$loop->iteration}})" class="btn btn-outline-secondary">Выбрать</button>
                    <input type="color"  class=" inputColor form-control form-control-color " value="#{{$color}}"  onchange="changeColor({{$loop->iteration}})">
                </article>
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
                $( "article,#btndelete").removeClass('selectColor')
                $("article>button").removeClass('active').text('Выбрать')

                console.log( $(this));
                $(this).addClass('selectColor');
                $(".stroke").removeClass().addClass("card-card-header p-2 stroke")
            }
        );

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
