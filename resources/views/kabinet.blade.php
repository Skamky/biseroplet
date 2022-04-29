@extends('layouts.app')
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning ">
                    <h5 class="modal-title" id="exampleModalLabel">Подтверждение</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="pDeleteElem">Удалить?</p>
                    <p id="pDeleteElem_data" class="text-black-50">(Обновлено:    hgkj hi  )</p>
                    <p class="text-danger"><small>В случае удаления схемы её невозможно будет восстановить!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <a id="linkdelete" class="btn btn-danger" href="#">Удалить</a>
                </div>
            </div>
        </div>
    </div>


    <script class="temp">
        let htmlcode="";
    </script>
    @if(Auth::user()->name==$ProfileName)
            <div class="mx-2 row row-cols-1 row-cols-md-2 g-4">

            @foreach($schemes as $scheme)
                <div class="col">
                    <div class="card">
{{--                        <img src="..." class="card-img-top" alt="">--}}

                        <div class="table-responsive">
                            <table id="table{{$scheme->id_scheme}}" class="table-borderless   table-responsive ">
                            </table>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$scheme->name_scheme}}</h5>
                            <p class="card-text">{{$scheme->description_scheme }}</p>
                            <form action="/save/access/{{$scheme->id_scheme}}" method="post" class="card-body">
                                @csrf
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                           @if($scheme->public==1)
                                           checked
                                           @endif
                                           name="public"
                                           id="flexSwitchCheckDefault{{$scheme->id_scheme}}">
                                    <label class="form-check-label" for="flexSwitchCheckDefault{{$scheme->id_scheme}}">Общедоступная схема</label>
                                </div>
                                <button type="submit" class="btn btn-outline-primary">Применить изменения</button>
                            </form>
                            <div class="card-body d-flex justify-content-between">
                                <a href="/profile/{{$ProfileName}}/{{$scheme->id_scheme}}" class="btn btn-primary">Открыть схему</a>
{{--                                <a href="/delete/{{$scheme->id_scheme}}" class="btn btn-outline-danger" title="Удалить схему">🗑</a>--}}
                                <button type="button" class="btn btn-outline-danger" onclick="pasteValue('{{$scheme->name_scheme}}',{{$scheme->id_scheme}},'{{$scheme->updated_at}}')" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    🗑
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Обновлено: {{$scheme->updated_at}}</small>
                            <br>
                            <small class="text-muted">Создано: {{$scheme->created_at}}</small>

                        </div>
                    </div>
                </div>
                    <div id="temp{{$scheme->id_scheme}}" class="temp">
                        {{$scheme->code_scheme}}
                    </div>

                    <script class="temp" >
                         htmlcode =$('#temp{{$scheme->id_scheme}}').text();
                        console.log('Проверка {{$scheme->id_scheme}}');
                       // console.log(htmlcode);
                        $('#table{{$scheme->id_scheme}}').append(htmlcode);

                    </script>
    @endforeach
                <script>
                    function pasteValue (label,id,updateDate)
                    {
                        console.log('начало')
                        $("#pDeleteElem").text("Удалить "+label+" ?");
                        $("#pDeleteElem_data").text("Обновлено: "+updateDate);
                        let newhref="/delete/"+String(id);
                        $("#linkdelete").attr("href",newhref);
                        console.log(newhref);
                    }

                    /*
Функция посылки запроса к файлу на сервере
r_method  - тип запроса: GET или POST
r_path    - путь к файлу
r_args    - аргументы вида a=1&b=2&c=3...
r_handler - функция-обработчик ответа от сервера
*/

                    $( ".form-switch" ).change(
                        function( event,idScheme )
                        {
                            console.log('начало ajax')

                            r_method="POST";
                            r_path ="/save/access/"+idScheme;

                            //Создаём запрос
                            var Request = CreateRequest();
//Проверяем существование запроса еще раз
                            if (!Request)
                            {
                                return;
                            }

                            //Назначаем пользовательский обработчик
                            Request.onreadystatechange = function()
                            {
                                //Если обмен данными завершен
                                if (Request.readyState == 4)
                                {
                                    //Передаем управление обработчику пользователя
                                    r_handler(Request);
                                }
                            }

                            //Инициализируем соединение
                            Request.open(r_method, r_path , true);

                            //Устанавливаем заголовок
                            Request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
                            //Посылаем запрос
                            Request.send(r_args);

                        }
                    );
                </script>
    @else
                    <div class="alert alert-warning alert-dismissible " role="alert">
                        Вы просматриваете профиль {{$ProfileName}}
                    </div>
                    < class="mx-2 row row-cols-1 row-cols-md-2 g-4">

                    @foreach($schemes as $scheme)
                <div class="col">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{$scheme->name_scheme}}</h5>
                            <p class="card-text">{{$scheme->description_scheme }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="/profile/{{$ProfileName}}/{{$scheme->id_scheme}}" class="btn btn-primary">Открыть схему</a>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Обновлено: {{$scheme->updated_at}}</small>
                        </div>
                    </div>
                </div>
    @endforeach
    @endif

                <script class="temp" defer>
                    scale(-5)

                    $('.temp').remove()
                </script>







@endsection
