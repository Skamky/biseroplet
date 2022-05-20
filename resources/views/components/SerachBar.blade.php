<form class="m-3 border p-3" method="post" action="{{ route('search') }}" >
    <p>Сортировка по</p>
    <div>
            <select name="orderBy1" class="form-select" aria-label="Default select example">
                <option value="0" selected>По умолчанию</option>
                <option value="name_scheme">По названию</option>
                <option value="login">По автору</option>
                <option value="created_at">По дате создания</option>
                <option value="updated_at">По дате изменения</option>
            </select>

        <div class="btn-group">
            <input type="radio" value="asc" class="btn-check" name="orderBy2" id="option1" autocomplete="off" title="Сортировка по возростанию" checked>
            <label class="btn btn-outline-primary" for="option1">⬆</label>

            <input type="radio"value="desc" class="btn-check" name="orderBy2" id="option2" autocomplete="off">
            <label class="btn btn-outline-primary" for="option2">⬇</label>
        </div>
    </div>
    <div class="input-group" title="Выберите 1 из вариантов">
        <label class="input-group-text">Категория</label>
        <select name="category" class="form-select" >
            <option value="0" selected>--Любая категория--</option>
            @foreach( $categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
    </div>
    Поиск
    <input name="search" type="search" value="{{old('search')}}">
    Колличество записей на странице<input type="number" min="4" value="{{old('countOnPage',50)}}" name="countOnPage">
    <button type="submit"> Поиск</button>
    @csrf

</form>
