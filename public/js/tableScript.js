function addRowToStart()
{

    let maxCountRows =Number($('tr').last().prev().find('th').html());

    let lastRow =$('tr').last().prev()
    let countRows = lastRow.find('th');
    let numRow;
    console.log("last stroke")
    console.log(lastRow.html())
    console.log(lastRow.html())

    for (let i=maxCountRows;i>0;i--)
    {
        numRow=Number(countRows.html())+1;
        countRows.text(numRow);
        lastRow= lastRow.prev().prev();
        countRows = lastRow.find('th');
    }

    let color = $(".selectColor").prop("id");

    let html1='<td></td><td><div class="ovalHoriz '+color+'"></div></td>'
    let html2 ='<td></td><td><div class="ovalVert '+color+'"></div></td>';

    let row1='<th scope="row">'+1+'</th><td><div class="ovalHoriz '+color+'"></div></td>'
    let row2='<th scope="row"></th>';

    let countColumns =$('thead th').last().html();

    for (let i=1;i<=countColumns;i++) {
        row1+=html1;
        row2+=html2;
    }

    $('tbody').prepend('<tr>'+row1+'</tr>');
    $('tbody').prepend('<tr>'+row2+'</tr>');
    console.log('строка добавлена')

    scale(0)
}


function addRowToEnd()
{
    let countRows = $('tr').last().prev().find('th').html();
    countRows=Number(countRows)+1

    let countColumns =$('thead th').last().html();

    let color = $(".selectColor").prop("id");

    let html1='<td></td><td><div class="ovalHoriz '+color+'"></div></td>'
    let html2 ='<td></td><td><div class="ovalVert '+color+'"></div></td>';

    let row1='<th scope="row">'+countRows+'</th><td><div class="ovalHoriz '+color+'"></div></td>'
    let row2='<th scope="row"></th>';

    for (let i=1;i<=countColumns;i++) {
        row1+=html1;
        row2+=html2;
    }
    // row1 = '<tr>+row1+</tr>'
    // row2 = '<tr>+row2+</tr>'
    console.log(row1)
    $('tbody').append('<tr>'+row1+'</tr>');
    $('tbody').append('<tr>'+row2+'</tr>');
    console.log('строка добавлена')

    scale(0)
}
function addColumnToStart()
{
    let countRows = $('tr').last().prev().find('th').html();

    let countColumns =$('thead th').last().html();
    countColumns=Number(countColumns)+1;
    $('thead tr').append('<th scope="col"></th><th scope="col">'+countColumns+'</th>')

    let color = $(".selectColor").prop("id");
    let html1 ='<td></td><td><div class="ovalVert '+color+'"></div></td>';
    let html2='<td><div class="ovalHoriz '+color+'"></div></td><td></td>'

    let row = $("tbody tr").first();
    for (let i=1;i<=countRows;i++) {
        row.find('th').after(html1);
        row.next().find('th').after(html2);
        row = row.next().next();
        console.log('столбец добавлен')
    }
    row.find('th').after(html1);

    scale(0)

}
function addColumnToEnd()
{
    let countRows = $('tr').last().prev().find('th').html();
    let countColumns =$('thead th').last().html();
    countColumns=Number(countColumns)+1;
    $('thead tr').append('<th scope="col"></th><th scope="col">'+countColumns+'</th>')

    let color = $(".selectColor").prop("id");

    let html1 ='<td></td><td><div class="ovalVert '+color+'"></div></td>';
    let html2='<td></td><td><div class="ovalHoriz '+color+'"></div></td>'

    let row = $("tbody tr").first();

    for (let i=1;i<=countRows;i++) {
        row.append(html1);
        row.next().append(html2);
        row = row.next().next();
        console.log('столбец добавлен')
    }
    row.append(html1);

    scale(0)

}
