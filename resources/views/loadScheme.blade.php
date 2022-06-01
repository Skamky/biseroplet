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
        <button class="btn btn-lg btn-outline-primary" onclick="raschet()">Количество цветов</button>

    </div>
    <hr>
    @auth
        <div>
            <h5>Сохранение схемы</h5>
{{--            <button onclick="ReadTable()"> Заполнить поля</button>--}}

            <form action="/save" method="post" class="row">
                <input name="id_scheme" type="hidden" value="{{$schemeId}}">
                <input name="color_scheme" type="hidden" id="color_scheme" required placeholder="цвета используемые в схеме">
                <input name="code_scheme"   id="code_scheme" type="hidden"  required placeholder="код схемы">
                <div class="d-flex align-items-stretch col-auto">
                    <div class="input-group" title="Выберите 1 из вариантов">
                        <label class="input-group-text">Категория</label>
                        <select name="category" class="form-select" >
                            @foreach( $categories as $category)
                                <option value="{{$category->id}}"
                                        @if($category->id==$scheme->category) selected
                                    @endif
                                >{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <textarea name="name_scheme" maxlength="250" rows="1" class="form-control"  required title="Название схемы" placeholder="Название схемы">{{$scheme->name_scheme}}</textarea>
                </div>
                <div class="col-auto">
                    <textarea name="description_scheme" maxlength="2500" rows="1" class="form-control " title="Описание схемы" placeholder="Описание схемы">{{$scheme->description_scheme}}</textarea>
                </div>

                <div class=" d-flex align-items-center  form-check form-switch col-auto  ">
                    <input class="form-check-input" type="checkbox" name="newScheme" id="flexSwitchCheckChecked" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">&#160;Перезаписать эту схему</label>
                </div>

                <button type="submit" class="btn btn-outline-success col-auto"  onmousedown="ReadTable()">{{__('Save')}}</button>
                @csrf
            </form>
        </div>
        <hr>
    @endauth

    <div  id="divFullPalitra" class="rounted shadow bottom-0 end-0 mx-1 card position-fixed z-index-1 h-50" style="z-index: 100">
        <h5 class="card-card-header p-2 stroke" onclick="hideShowPalitra()">Палитра</h5>

        <div class="card-body overflow-auto " id="divPalitra">
            Добавить новый цвет <button onclick="addColor()">➕</button>
            <br>
            Удалить элемент <button id="btndelete" class="selectColor" >❌</button>
            @foreach($colors as $color)
            <hr>
{{--             Цвет {{$loop->iteration}}:<input type="color" id="color{{$loop->iteration}}" class="inputColor form-control form-control-color selectColor" value="#{{$color}}" onclick="selectPalitra({{$loop->iteration}})" onchange="changeColor({{$loop->iteration}})">--}}
                <article id="color{{$loop->iteration}}" class=" d-flex justify-content-between align-items-center">
                    Цвет {{$colorsCount=$loop->iteration}}:
                    <button type="button" onclick="selectPalitra({{$loop->iteration}})" class="btn btn-outline-secondary">Выбрать</button>
                    <input type="color"  class=" inputColor form-control form-control-color " value="#{{$color}}" title="Изменить этот цвет" onchange="changeColor({{$loop->iteration}})">
                </article>
            @endforeach
            <script>
                CountColor={{$colorsCount}};
                console.log('Количество цветов')
                console.log(CountColor)
            </script>
        </div>
    </div>
    {{--табличка--}}
    <div id="table_for_print">
        <div class="table-responsive">
            <table class="table-borderless   table-responsive ">
                {!! $scheme->code_scheme!!}
            </table>
        </div>
    </div>

    <div id="divStyles">
        <style id="stPalitra">
            @foreach($colors as $color )
            .color{{$loop->iteration}}{background-color:#{{$color}};}
            @endforeach
        </style>
    <style id="stTransform"> </style>
    </div>

    <script>
        $('tbody').on("click",".ovalHoriz,.ovalVert",paint)
        $( "#btndelete" ).click(selectDelete);
    </script>

@endsection
