@extends('layouts.app')

@section('content')

<form action="/generate" method="post">
    <div class="m-3">
        <label> Ширина</label>
        <input class="form-control" type="number" name="width_sc" required min="1">
        <label> Высота</label>
        <input class="form-control" type="number" name="height_sc"  required min="1">
        <label> Цвет</label>
        <input class="form-control" type="color" value="#FFFFFF" name="color_sc">
    <hr>
    <input class="btn  btn-primary " type="submit">
    </div>
    @csrf
</form>

@endsection
