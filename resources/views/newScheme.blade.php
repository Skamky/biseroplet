@extends('layouts.app')

@section('content')
{{--Панель инструментов--}}
<h5>Инструменты</h5>
<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div id="div Tools" class="btn-group btn-group-lg" role="group">
        <button title="Увеличить схему" class="btn btn-outline-info" onclick="scale(1)"><i class="bi bi-zoom-in"></i></button>
        <button title="Уменьшить схему" class="btn btn-outline-info" onclick="scale(-1)"><i class="bi bi-zoom-out"></i></button>
        <button class="btn btn-outline-info" onclick="printSchema()" title="Экспорт в PDF или печать"><i class="bi bi-file-pdf-fill" aria-hidden="true"></i></button>
    </div>
    <button class="btn btn-lg btn-outline-info" onclick="raschet()" title="Количество цветов" aria-label="Количество цветов"><i class="bi bi-calculator" aria-hidden="true"></i></button>

    <div  class="btn-group btn-group-lg" role="group">
        <button class="btn btn-outline-info" onclick="addRowToStart()" title="Добавить строку сверху"><i class="bi bi-box-arrow-up"></i></button>
        <button class="btn btn-outline-info" onclick="addRowToEnd()" title="Добавить строку снизу"><i class="bi bi-box-arrow-down"></i></button>
        <button class="btn btn-outline-info" onclick="addColumnToStart()" title="Добавить столбец в начале"><i class="bi bi-box-arrow-left"></i></button>
        <button class="btn btn-outline-info" onclick="addColumnToEnd()" title="Добавить стобец в конце"><i class="bi bi-box-arrow-right"></i></button>
    </div>
        <div class="btn-group ">
            <input type="radio"  class="btn-check" name="radioDelete" id="deleteElem"  value="element" autocomplete="off"  >
            <label class="btn btn-outline-danger" for="deleteElem"  onmousedown="radioDeleteMouseDown('deleteElem')">Удалить элемнт</label>

            <input type="radio"  class="btn-check" name="radioDelete" id="deleteRow"   value="row" autocomplete="off"   >
            <label class="btn btn-outline-danger" for="deleteRow"  onmousedown="radioDeleteMouseDown('deleteRow')">Удалить строку </label>

            <input type="radio" class="btn-check" name="radioDelete" id="deleteColumn" value="column" autocomplete="off"   >
            <label class="btn btn-outline-danger" for="deleteColumn" onmousedown="radioDeleteMouseDown('deleteColumn')">Удалить столбец</label>
        </div>
    <div class="btn-group d-none deleteBar">
        <button class="btn btn-primary" onclick="if(confirm('Удалить выбранные элементы? '))   $('.willBeDeleted').remove();">
            Применить</button>
        <button class="btn btn-secondary" onclick="Otmena()" >Отменить</button>
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
            <div class="input-group" title="Выберите 1 из вариантов">
                <label class="input-group-text">Категория</label>
                <select name="category" class="form-select" >
                    @foreach( $categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-auto">
        <input name="name_scheme" maxlength="250" class="form-control col-auto" required title="Название схемы" placeholder="Название схемы">
        </div>
        <div class="col-auto">
        <input name="description_scheme" maxlength="2500" class="form-control col-auto" title="Описание схемы" placeholder="Описание схемы">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-success col-auto"  onmousedown="ReadTable()">{{__('Save')}}</button>
        </div>
        @csrf
    </form>
</div>
    <hr>
@endauth

<div  id="divFullPalitra" class="rounted shadow bottom-0 end-0 mx-1 card position-fixed h-50" style="z-index: 100">
<h5 class="card-card-header p-2 stroke" onclick="hideShowPalitra()" title="Нажми что бы скрыть">Палитра</h5>

    <div class="card-body overflow-auto " id="divPalitra">
        Добавить новый цвет <button onclick="addColor()">➕</button>
{{--        <br>--}}
{{--        Удалить элемент <button id="btndelete"  >❌</button>--}}

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



<div id="divStyles">
<style id="stPalitra">
    .color1{background-color:{{$color}};}
</style>
<style id="stTransform"> </style>
</div>
<script>
    $('tbody').on("click",".ovalHoriz,.ovalVert",paint)
    // $( "#btndelete" ).click(selectDelete);
    $('input[name=radioDelete]').click(radioDeleteClick)
    $('input[name=radioDelete]').mousedown(radioDeleteMouseDown)
    // function    deeleteSelected(){
    //   if(confirm('Удалить выбранные элементы? '))   $('.willBeDeleted').remove();
    // }
    // function Otmena(otmena=false)
    // {
    //     if($('.willBeDeleted').length===0)
    //     {
    //         otmena=true
    //     }
    //     //let otmena=false;
    //     if(!otmena)
    //     {
    //         otmena =  confirm('Отменить изменения?');
    //     }
    //     if(otmena)
    //     {
    //         $('.willBeDeleted').removeClass('willBeDeleted');
    //         $('table').removeClass('border border-danger');
    //         $('.deleteBar').addClass('d-none');
    //         $('input[name=radioDelete]:checked').prop('checked', false);
    //     }
    //
    // }

</script>
@endsection
