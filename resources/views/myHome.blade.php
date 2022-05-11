@extends('layouts.app')

@section('content')
{{--Панель инструментов--}}
<div>
<h5>Инструменты</h5>
    <div id="div Tools" class="btn-group btn-group-lg" role="group">
        <button title="Увеличить схему" class="btn btn-outline-secondary" onclick="scale(1)">+</button>
        <button title="Уменьшить схему" class="btn btn-outline-secondary" onclick="scale(-1)">-</button>
        <button class="btn btn-outline-primary" onclick="printSchema()" title="Экспорт в PDF или печать">Экспорт</button>
    </div>
    <div  class="btn-group btn-group-lg" role="group">
        <button class="btn btn-outline-secondary" onclick="addRowToStart()" title="Добавить строку сверху">🔼</button>
        <button class="btn btn-outline-secondary" onclick="addRowToEnd()" title="Добавить строку снизу">🔽</button>
        <button class="btn btn-outline-secondary" onclick="addColumnToStart()" title="Добавить столбец в начале">◀</button>
        <button class="btn btn-outline-secondary" onclick="addColumnToEnd()" title="Добавить стобец в конце">▶</button>
    </div>
</div>
<hr>
@auth
<div>
    <h5>Сохранение схемы</h5>
{{--    <button onclick="ReadTable()"> Заполнить поля</button>--}}

    <form action="/save" method="post" class="row">
        <input name="color_scheme" required  id="color_scheme" type="hidden"  required placeholder="цвета используемые в схеме">
        <input name="code_scheme" required  id="code_scheme" type="hidden"   placeholder="код схемы">
        <div class="col-auto">
        <input name="name_scheme" maxlength="250" class="form-control col-auto" required title="Название схемы" placeholder="Название схемы">
        </div>
        <div class="col-auto">
        <input name="description_scheme" maxlength="2500" class="form-control col-auto" title="Описание схемы" placeholder="Описание схемы">
        </div>

        <button type="submit" class="btn btn-outline-success col-auto"  onmousedown="ReadTable()">{{__('Save')}}</button>
        @csrf
    </form>
</div>
    <hr>
@endauth

<div  id="divFullPalitra" class="rounted shadow bottom-0 end-0 mx-1 card position-fixed h-50">
<h5 class="card-card-header p-2 stroke" onclick="hideShowPalitra()">Палитра</h5>

    <div class="card-body overflow-auto " id="divPalitra">
        Добавить новый цвет <button onclick="addColor()">➕</button>
        <br>
        Удалить элемент <button id="btndelete"  >❌</button>

        <hr>
        <article id="color1" class="selectColor d-flex justify-content-between align-items-center">
            Цвет 1:
            <button type="button" onclick="selectPalitra(1)" class="btn btn-outline-secondary active">Выбран</button>
            <input type="color" title="Изменить этот цвет" class=" inputColor form-control form-control-color " value="{{$color}}"  onchange="changeColor(1)">
        </article>

    </div>
</div>
{{--табличка--}}
<div id="table_for_print">
<div class="table-responsive">
<table  class="table-borderless   table-responsive ">
{{--    <table  class="table table-secondary table-bordered">--}}

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
        <td><div class="ovalVert color1"></div></td>
        @endfor
    </tr>
    @for ($s = 1; $s <= $h; $s++)
    <tr>
        <th scope="row">{{$s}}</th>
        <td><div class="ovalHoriz color1"></div></td>
    @for ($i = 1; $i <= $w; $i++)
            <td></td>
            <td><div class="ovalHoriz color1"></div></td>
        @endfor
    </tr>
    <tr>
        <th scope="row"></th>
        @for ($i = 0; $i < $w; $i++)
            <td></td>
            <td><div class="ovalVert color1"></div></td>
        @endfor
        @endfor
    </tr>
    </tbody>

        </table>
    </div>
</div>

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
    .color1{background-color:{{$color}};}
</style>
<style id="stTransform"> </style>
</div>
@endsection
