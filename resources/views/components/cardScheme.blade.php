<div class="col">
    <div class="card">
        {{--                <img src="..." class="card-img-top" alt="">--}}

            <div class="accordion accordion-flush" id="accordion{{$scheme->id_scheme}}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo{{$scheme->id_scheme}}" aria-expanded="false" aria-controls="collapseTwo{{$scheme->id_scheme}}">
                            <h5 class="card-title">{{$scheme->name_scheme}}</h5>                            </button>
                    </h2>
                    <div id="collapseTwo{{$scheme->id_scheme}}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion{{$scheme->id_scheme}}">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table id="table{{$scheme->id_scheme}}" class="table-borderless   table-responsive ">
                                </table>
                            </div>
                        </div>
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


        <ul class="list-group list-group-flush">
            <li class="list-group-item">Автор: {{$scheme->login }}</li>
            <li class="list-group-item">Категория: {{$scheme->category}}</li>
            @if($scheme->description_scheme!=null )
                <div class="card-body">
                    {{--                    <h5 class="card-title">{{$scheme->name_scheme}}</h5>--}}
                    <p class="card-text">{{$scheme->description_scheme }}</p>
                </div>
            @endif
            <a href="/profile/{{$scheme->login}}/{{$scheme->id_scheme}}" class="list-group-item list-group-item-action list-group-item-primary">Открыть схему</a>
{{--            <ul class="list-group  list-group-horizontal-lg">--}}
{{--                <li class="list-group-item ">--}}
{{--                    Элемент списка--}}
{{--                    <span class="badge bg-primary rounded-pill">14</span>--}}
{{--                </li>--}}
{{--                <li class="list-group-item">--}}
{{--                    Второй элемент списка--}}
{{--                    <span class="badge bg-primary rounded-pill">2</span>--}}
{{--                </li>--}}
{{--            </ul>--}}

        </ul>
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item">
                👍🏻
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item">
                👎🏻
                <span class="badge bg-primary rounded-pill">2</span>
            </li>
        </ul>






        <div class="card-footer">
            <small class="text-muted">Обновлено: {{$scheme->updated_at}}</small>
            <br>
            <small class="text-muted">Создано: {{$scheme->created_at}}</small>

        </div>
    </div>
</div>
