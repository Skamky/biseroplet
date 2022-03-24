@include("header")


<div class="card">
<h2 class="card-card-header"> Палитра</h2>
    <div class="card-body">
    Первичный цвет:<input type="color" id="color1" class="rounded selectColor" value="{{$color}}">
    Вторичный цвет:<input type="color" id="color2" class="rounded " >
    Третичный цвет <input type="color" id="color3" class="rounded" >
    Акценты:       <input type="color" id="color4" class="rounded" >
    Удалить эллемент <button id="btndelete" >❌</button>
    </div>
</div>
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
               // let color = $(".selectColor").val();
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
    $( "[type='color'],#btndelete" ).click(
        function( event )
        {
            $( "[type='color'],#btndelete").removeClass('selectColor')
            // console.log( $(this).prop('className'));
             $(this).addClass('selectColor');
            // console.log( $(this).prop('className'));
            // console.log( $(this).val());
        }
    );
    //изменение цвета в зависимости от выбранной палтры
    $( "[type='color']").change(
        function( event )
        {
            let idpalitra = this.id;
            let newcolor =$(".selectColor").val();
            //console.log(this.id);
            console.log(newcolor);


            let htmlstyle ="<style id="+idpalitra+">."+idpalitra+"{background-color:"+newcolor+";} </style>";
           $('#css'+idpalitra).empty();
           $('body').append(htmlstyle);

       // $('#css'+idpalitra).replaceWith(temp);
            console.log('#css'+idpalitra);

        }
    )
</script>

<style id="csscolor1">
    .color1{background-color: {{$color}};}
</style>
<style id="csscolor2">
    .color2{background-color:black;}
</style>
<style id="csscolor3">
    .color3{background-color:black;}
</style>
<style id="csscolor4">
    .color4{background-color:black;}
</style>

</html>
