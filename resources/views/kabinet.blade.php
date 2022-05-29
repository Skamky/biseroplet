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

<h1>Профиль</h1>
    <script class="temp">
        let htmlcode="";
    </script>
    {{ $schemes->links() }}
    @if(Auth::user()->name==$ProfileName)
            <div class="mx-2 row row-cols-1 row-cols-md-2 g-4">

            @foreach($schemes as $scheme)
                    <div class="col animated moving" id="column{{$scheme->id_scheme}}">
                        <div class="card">
                            {{--                <img src="..." class="card-img-top" alt="">--}}
                            <div class="accordion accordion-flush" id="accordion{{$scheme->id_scheme}}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo{{$scheme->id_scheme}}" aria-expanded="false" aria-controls="collapseTwo{{$scheme->id_scheme}} "   onclick="peremWidth('#column{{$scheme->id_scheme}}')">
                                            <h5 class="card-title">{{$scheme->name_scheme}}</h5>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo{{$scheme->id_scheme}}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion{{$scheme->id_scheme}}">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table id="table{{$scheme->id_scheme}}" class="table-borderless   table-responsive ">
                                                    {!! $scheme->code_scheme!!}
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
{{--                                <h5 class="card-title">{{$scheme->name_scheme}}</h5>--}}
                                <p class="card-text">Категория: {{$scheme->category}}</p>
                                <p class="card-text">{{$scheme->description_scheme }}</p>
                                    <div class="form-check form-switch" value="{{$scheme->id_scheme}}">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                               @if($scheme->public==1)
                                               checked
                                               @endif
                                               name="public"
                                               id="flexSwitchCheckDefault{{$scheme->id_scheme}}">
                                        <label class="form-check-label" for="flexSwitchCheckDefault{{$scheme->id_scheme}}">Общедоступная схема</label>
                                    </div>
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





                    $( ".form-switch" ).change(
                        function( event) {

                           let schemeid=  $(this).attr('value');
                           let inputswitch = $(this).children('input');
                            inputswitch.attr('disabled','disabled');
                            setTimeout(enabledFormswitch,3000,inputswitch);
                           let url;
                           console.log( inputswitch.prop("checked"));
                          let datarequest={id_scheme:schemeid,public:inputswitch.prop("checked") }

                           url = '/save/access/'
                            $.get(url,datarequest,CallbackToConsole)
                        }
                    );
                    function enabledFormswitch(inputswitch)
                    {
                        inputswitch.removeAttr('disabled');
                    }

                </script>
    @else
                    <div class="alert alert-warning alert-dismissible " role="alert">
                        Вы просматриваете профиль {{$ProfileName}}
                    </div>
                    <div  class="mx-2 row row-cols-1 row-cols-md-2 g-4">

                    @foreach($schemes as $scheme)
                            @include('components.cardScheme')
                        @endforeach
                    </div>
            <script>
                function like(schemaId,value,thisIdElem,idContainer) {
                    thisIdElem=$(thisIdElem);
                    $(idContainer).html('<button class="btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>🥱 Пожалуйста подождите...</button>')

                    console.log(thisIdElem);
                    let url;
                    if (thisIdElem.hasClass('active'))
                        url='{{route('ajax')}}/'+schemaId+'/0';
                    else
                        url='{{route('ajax')}}/'+schemaId+'/'+value;
                    // $.get(url,myCallback)
                    $(idContainer).load(url);
                }

            </script>
    @endif
                {{ $schemes->links() }}

                <script class="temp" defer>
                    scale(-5)
                    $('.temp').remove()
                </script>
                <style>
                    @foreach($schemes as $scheme)
        @foreach($scheme->color_scheme as $color )
            .id{{$scheme->id_scheme}}color{{$loop->iteration}}{background-color:#{{$color}};}
                    @endforeach
                    @endforeach
                </style>







@endsection
