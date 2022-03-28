// доабавление цвета на палитру
let CountColor = 1;
let ScaleValue =1;
function addColor()
{
    CountColor++;
    let html= '<hr>Цвет '+CountColor+':<input type="color" id="color'+CountColor+'" class="rounded" value="#ffffff" onchange="changeColor('+CountColor+')" onclick="selectPalitra('+CountColor+')" >';
    $("#divPalitra").append(html);
}


function changeColor( num )
{
    let idpalitra = "color"+num;
    let newcolor =$(".selectColor").val();
    //console.log(this.id);
    console.log(newcolor);

    let htmlstyle ="."+idpalitra+"{background-color:"+newcolor+";}";
    // $('#css'+idpalitra).empty();
    $('#stPalitra').append(htmlstyle);

    // $('#css'+idpalitra).replaceWith(temp);
    console.log('#css'+idpalitra);

}
function selectPalitra (num)
{
    console.log("select")
    $( "[type='color'],#btndelete").removeClass('selectColor')
    console.log( $(this));
    $("#color"+num).addClass('selectColor');
    // console.log( $(this).prop('className'));
    // console.log( $(this).val());
}


function scale(increase)
{

    let w= $(".ovalHoriz").outerWidth();
    let h= $(".ovalHoriz").outerHeight();
    if(increase==1 ||(w>10 && h>10))
    {
        $(".ovalHoriz").outerWidth(w+(w/100*10*increase)).outerHeight(h+(h/100*10*increase));
        console.log(w+"\t"+h);

        w= $(".ovalVert").outerWidth();
        h= $(".ovalVert").outerHeight();
        $(".ovalVert").outerWidth(w+(w/100*10*increase)).outerHeight(h+(h/100*10*increase));
        console.log(w+"\t"+h);
    }
}
