@include("header")


<div class=" shadow bottom-0 start-0 h-50  card position-fixed ">
<h5 class="card-card-header"> Палитра</h5>
    <div class="card-body overflow-auto " id="divPalitra">
        Добавить новый цвет <button onclick="addColor()">➕</button>
        <br>
        Удалить эллемент <button id="btndelete"  >❌</button>
        <hr>
        Первичный цвет:<input type="color" id="color1" class="rounded selectColor" value="{{$color}}" onclick="selectPalitra(1)" onchange="changeColor(1)">
{{--    Вторичный цвет:<input type="color" id="color2" class="rounded " >--}}
{{--    Третичный цвет <input type="color" id="color3" class="rounded" >--}}
{{--    Акценты:       <input type="color" id="color4" class="rounded" >--}}

    </div>
</div>
<div class="table-responsive">
<table class="table-borderless   table-responsive ">
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
        <td><div class="ovalVert color1"></div> </td>
        @endfor
    </tr>
    @for ($s = 1; $s <= $h; $s++)
    <tr>
        <th scope="row">{{$s}}&nbsp</th>
        @for ($i = 1; $i <= $w+1; $i++)
        <td><div class="ovalHoriz color1"></div> </td>
        <td></td>
        @endfor
    </tr>
    <tr>
        <th scope="row"></th>
        @for ($i = 0; $i < $w; $i++)
            <td></td>
            <td><div class="ovalVert color1"></div> </td>
        @endfor
        @endfor
    </tr>
    </tbody>
</table>
</div>
</body>
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

<style id="csscolor1">
    .color1{background-color: {{$color}};}
</style>
</html>
