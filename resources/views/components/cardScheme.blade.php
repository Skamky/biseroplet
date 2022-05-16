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
        <div class="card-body">
            {{--                    <h5 class="card-title">{{$scheme->name_scheme}}</h5>--}}
            <p class="card-text">Категория: {{$scheme->category}}</p>
            <p class="card-text">{{$scheme->description_scheme }}</p>
            <p class="card-text">Автор: {{$scheme->login }}</p>
            <a href="/profile/{{$scheme->login}}/{{$scheme->id_scheme}}" class="btn btn-primary">Открыть схему</a>
            {{--                                <a href="/delete/{{$scheme->id_scheme}}" class="btn btn-outline-danger" title="Удалить схему">🗑</a>--}}


        </div>
        <div class="card-footer">
            <small class="text-muted">Обновлено: {{$scheme->updated_at}}</small>
            <br>
            <small class="text-muted">Создано: {{$scheme->created_at}}</small>

        </div>
    </div>
</div>
