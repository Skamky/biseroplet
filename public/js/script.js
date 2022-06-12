// доабавление цвета на палитру
let CountColor = 1;
//покраска эллемента
function paint( event )
{

    let orentation;
    if ($(this).hasClass("ovalVert")) {
        orentation = "ovalVert ";
    }
    else {
        orentation = "ovalHoriz ";
    }
    let delAction = $('input[name=radioDelete]:checked').val();
    console.log(delAction)
    switch (delAction) {
        case "element":
            $(this).css('opacity',0 );
            //$(this).toggleClass('opacity-0');
            $(this).removeClass().addClass(orentation);
            console.log('ELEMENT')
            break;
        case "row":
            $(this).parent().parent().toggleClass('willBeDeleted');
            console.log('ROW')
            break;
        case "column":
            console.log('COLUMN')

            let th_num = $(this).parent().index()-1;
            $('tbody tr').each(function(){
                $(this).children('td').each(function(td_num){
                    if(td_num===th_num){
                        $(this).toggleClass('willBeDeleted');
                    }
                })
            })


            break;
        default:
            let color = $(".selectColor").prop("id");
            //console.log(color);

            $(this).removeClass().addClass(orentation+color);

            //$(this).css('background', color);
            $(this).css('opacity',1)

            console.log('PAINT');
    }
}

function addColor()
{
    CountColor++;
    let html='<hr>';
    html+='<article  id="color'+CountColor+'" class=" d-flex justify-content-between align-items-center">Цвет '+CountColor+':';
     html+= '<button type="button" class="btn btn-outline-secondary " onclick="selectPalitra('+CountColor+')">Выбрать</button>';
     html+='<input type="color" title="Изменить этот цвет" class="form-control form-control-color inputColor" value="#ffffff" onchange="changeColor('+CountColor+')"  >';
     html+='</article>'
    $("#divPalitra").append(html);
}


function changeColor( num )
{
    let idpalitra = "color"+num;
    let newcolor =$('#'+idpalitra+">input").val();

    // console.log('#'+idpalitra+">input")
    // console.log(this.id);
    console.log(newcolor);

    let htmlstyle ="."+idpalitra+"{background-color:"+newcolor+";} .selectColor{ border:3px groove "+newcolor+";}";
    // $('#css'+idpalitra).empty();
    $('#stPalitra').append(htmlstyle);
    $("#headingOne").css( 'border',"5px solid "+newcolor)
    $("#divFullPalitra").css( 'border',"5px solid "+newcolor)
    $('hr').css('color',newcolor)

    // $('#css'+idpalitra).replaceWith(temp);
    console.log('#css'+idpalitra);

}
function selectPalitra (num)
{
    console.log("select")
    $( "article,#btndelete").removeClass('selectColor')
    $("article>button").removeClass('active').text('Выбрать')

    $("#color"+num).addClass('selectColor')
    $('.selectColor>button').addClass('active').text("Выбран")

    let color=  $('.selectColor>input').val()
    let htmlstyle =".selectColor{ border:3px groove "+color+";}";
    // $('#css'+idpalitra).empty();
    $('#stPalitra').append(htmlstyle);
    $("#headingOne").css( 'border',"5px solid "+color)
    $("#divFullPalitra").css( 'border',"5px solid "+color)
    $('hr').css('color',color)
    // console.log( $(this).prop('className'));
    // console.log( $(this).val());
}
function selectDelete ( event )
{
    console.log("select")
    $( "article,#btndelete").removeClass('selectColor')
    $("article>button").removeClass('active').text('Выбрать')

    console.log( $(this));
    $(this).addClass('selectColor');
    $(".stroke").removeClass().addClass("card-card-header p-2 stroke")

}
function printSchema()
{
    if(!window.print){
        console.log('функция недоступна');
        alert('Данная функция недоступна на вашей платформе 😓');
        return;
    }
    console.log('начало печати');
    var printCSSbotrap ='<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">'   // var printTitle = document.getElementById('print-title').innerHTML;
    var printCSS2 = '<style media="print" type="text/css">.ovalHoriz{width: 100px;height: 50px; border-radius: 50%; border:3px solid black;color: red;} .ovalVert{width: 50px;height: 100px; border-radius: 50%; border:3px solid black;}</style>';
    var printPalitra=document.getElementById('divStyles').innerHTML;
    var printText = document.getElementById('table_for_print').innerHTML;
    var windowPrint = window.open('','','left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0');

    windowPrint.document.write(printCSSbotrap);
    windowPrint.document.write(printCSS2);
    windowPrint.document.write(printPalitra);
    windowPrint.document.write(printText);
    windowPrint.document.close();

    windowPrint.focus();
    windowPrint.print();
    windowPrint.close();
}

function scale(increase)
{

    let w= $(".ovalHoriz[style]").outerWidth();
    let h= $(".ovalHoriz[style]").outerHeight();

    console.log('scale')
    console.log(w);
    if (!w)
    {
         w= $(".ovalHoriz").outerWidth();
         h= $(".ovalHoriz").outerHeight();
    }

    if(increase==1 ||(w>10 && h>10))
    {
        $(".ovalHoriz").outerWidth(w+(w/100*10*increase)).outerHeight(h+(h/100*10*increase));
        console.log(w+"\t"+h);

        w= $(".ovalVert[style]").outerWidth();
        h= $(".ovalVert[style]").outerHeight();
        if(!w)
        {
            w= $(".ovalVert").outerWidth();
            h= $(".ovalVert").outerHeight();
        }
        $(".ovalVert").outerWidth(w+(w/100*10*increase)).outerHeight(h+(h/100*10*increase));
        console.log(w+"\t"+h);
    }
}

function ReadTable()
{
    Otmena(true);
    let colors="";
    console.log($('#table_schema').html())

    console.log("цвета");
    $('.inputColor').each(function( index )
    {
        colors+=$( this ).val();
        console.log( index + ": " + $( this ).val());
    });
    console.log(colors);
    $('#code_scheme').val($('#table_schema').html());
    $('#color_scheme').val(colors.slice(1));
}
function hideShowPalitra()
{
    // if( $("#divPalitra").hasClass('collapse'))
    // {
    //     $("#divPalitra").removeClass('collapse');
    //     $("#divFullPalitra").addClass('h-50');
    // }
    // else {
    //     $("#divPalitra").addClass('collapse');
    //     $("#divFullPalitra").removeClass('h-50');
    // }
}

function raschet()
{
    console.log('Количество цветов '+CountColor);
    let html='<div class="alert alert-light  alert-dismissible fade show" role="alert">';
    for (let i = 1; i <=CountColor ; i++) {
        html+='<div class="px-5 color'+i+'"> <p class="bg-light"> Цвет '+i+': '+ $('td>.color'+i).length+' шт</p></div>' ;
    }
    html+= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    </div>';
    $('.alertsContainer').append(html);
}
function CallbackToConsole( returnedData ) {
    console.log(returnedData)
}


function peremWidth(idColumn) {
    if($(idColumn).outerWidth()==$(idColumn).parent().outerWidth()){
        console.log('ширина уже 100')
        $(idColumn).removeAttr('style')
    }
    else {
        $(idColumn).outerWidth('100%')
        console.log('Ширина 100')
    }
}

function Otmena(otmena=false)
{
    if($('.willBeDeleted').length===0)
    {
        otmena=true
    }
    //let otmena=false;
    if(!otmena)
    {
        otmena =  confirm('Отменить изменения?');
    }
    if(otmena)
    {
        $('.willBeDeleted').removeClass('willBeDeleted');
        $('table').removeClass('border border-danger');
        $('.deleteBar').addClass('d-none');
        $('input[name=radioDelete]:checked').prop('checked', false);
    }

}
function radioDeleteMouseDown(radioId)
{
    let radio =document.getElementById(radioId)
    radio.isChecked=radio.checked;
}
function radioDeleteClick()
{
    this.checked=!this.isChecked;
    console.log($(this).prop('checked'))
    console.log(this)
    if($(this).prop('checked')){
        $('table').addClass('border border-danger');
        $('.deleteBar').removeClass('d-none')
    }
    else {
        $('table').removeClass('border border-danger');
        $('.deleteBar').addClass('d-none');


    }
}
