<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<!--    <link rel="icon" type="image/png" href="img/logo2.png">-->
<!--    <link rel="stylesheet" type="text/css" href="style.css">-->
<!--    <script  src="script.js" async defer></script>-->
    <link rel="shortcut icon" href="/img/catico.gif" type="image/gif">
    <!--    jqury-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!--мой CSS-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title></title>
</head>
<body  >
<!-- Вариант 1: пакет Bootstrap с Popper должно быть в конце -->
<script async defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Biserplet</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
{{--                <a class="nav-link " aria-current="page" href="welcome">welcome</a>--}}
                <a class="nav-link" href="/">home </a>
                <a class="nav-link" href="https://forms.gle/HM8v4NR4kS5DLiWw5">Оставить отзыв</a>
{{--                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>--}}
            </div>
        </div>
    </div>
</nav>
<div class="alert alert-warning" role="alert">
    Сайт находиться в активной стадии разработки, возможны ошибки и изменения, для мобильных устройств рекомендуеться планшетный режим
</div>

<script>
    $( "nav" ).click(
        function( event )
        {
            console.log( $(this).prop('className'));
            $(this).addClass('active');
            console.log( $(this).prop('className'));
        }
    );
</script>
