// доабавление цвета на палитру
let CountColor = 1;
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

    let htmlstyle ="<style id="+idpalitra+">."+idpalitra+"{background-color:"+newcolor+";} </style>";
    $('#css'+idpalitra).empty();
    $('body').append(htmlstyle);

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

