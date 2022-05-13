@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Создать схему</div>
<form action="/generate" method="post">
    <div class="m-3">
        <label> Ширина</label>
        <input class="form-control" type="number" name="width_sc" required min="1" max="50">
        <label> Высота</label>
        <input class="form-control" type="number" name="height_sc"  required min="1" max="50">
        <label> Цвет</label>
        <input class="form-control" type="color" value="#FFFFFF" name="color_sc">
    <hr>
        <button class="btn  btn-primary " type="submit">Создать</button>
    </div>
    @csrf
</form>
</div>

@endsection
