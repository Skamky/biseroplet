<div class="col animated moving" id="column{{$scheme->id_scheme}}">
    <div class="card border-success ">
        {{--                <img src="..." class="card-img-top" alt="">--}}

            <div class="accordion accordion-flush" id="accordion{{$scheme->id_scheme}}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo{{$scheme->id_scheme}}"
                                aria-expanded="false" aria-controls="collapseTwo{{$scheme->id_scheme}}"
                                onclick="peremWidth('#column{{$scheme->id_scheme}}')">
                            <h5 class="card-title">{{$scheme->name_scheme}}</h5>
                        </button>
                    </h2>
                    <ul class="list-group list-group-flush">
                        <li class="temp list-group-item">
                            <div class="d-flex align-items-center">
                                <strong>Загрузка предпросмотра...</strong>
                                <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                            </div>
                        </li>
                        <li class="list-group-item">Автор: <a href="/profile/{{$scheme->login }}" title="Перейти в профиль автора">{{$scheme->login }}</a></li>
                        <li class="list-group-item">Категория: {{$scheme->category}}</li>
                        @if($scheme->description_scheme!=null )
                            <div class="card-body">
                                {{--                    <h5 class="card-title">{{$scheme->name_scheme}}</h5>--}}
                                <p class="card-text">{{$scheme->description_scheme }}</p>
                            </div>
                        @endif
                        <a href="/profile/{{$scheme->login}}/{{$scheme->id_scheme}}" class="list-group-item list-group-item-action list-group-item-primary">Открыть схему</a>
                    </ul>
                    <div id="collapseTwo{{$scheme->id_scheme}}" class=" accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion{{$scheme->id_scheme}}">
                        <div class="accordion-body px-0 py-1">
                            <div class="table-responsive">
                                <table id="table{{$scheme->id_scheme}}" class="table-borderless   table-responsive ">
                                    {!! $scheme->code_scheme!!}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        @auth()
            <div id="likeBar{{$scheme->id_scheme}}">
            @include('components.likeBar')
            </div>
        @endauth
        <div class="card-footer">
            <small class="text-muted">Обновлено: {{$scheme->updated_at}}</small>
            <br>
            <small class="text-muted">Создано: {{$scheme->created_at}}</small>

        </div>
    </div>
</div>

