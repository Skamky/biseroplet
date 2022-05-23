<form class="m-3 border p-3" method="post" action="{{ route('search') }}" >
    <label>Сортировка</label>
    <div class="input-group">
        <div class="btn-group">
            <input type="radio" value="asc" class="btn-check" name="orderBy2" id="option1" autocomplete="off" title="Сортировка по возростанию" checked>
            <label class="btn btn-outline-primary" for="option1" title="Сортировка по возростанию">⬆</label>

            <input type="radio"value="desc" class="btn-check" name="orderBy2" id="option2" autocomplete="off" title="Сортировка по убыванию">
            <label class="btn btn-outline-primary" for="option2" title="Сортировка по убыванию">⬇</label>
        </div>
        <select name="orderBy1" class="form-select" aria-label="Default select example">
                <option value="0" selected>По умолчанию</option>
                <option value="name_scheme">По названию</option>
                <option value="login">По автору</option>
                <option value="created_at">По дате создания</option>
                <option value="updated_at">По дате изменения</option>
        </select>
    </div>
    <label>Категория</label>
    <div class="input-group" title="Выберите 1 из вариантов">

        <select name="category" class="form-select" >
            <option value="0" selected>--Любая категория--</option>
            @foreach( $categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
    </div>
    <label>Автор</label>
    <input name="author" class="form-control" list="datalistAuthor" value="{{old('Author')}}">
    <datalist id="datalistAuthor">
        @foreach($dataListUsers as $dataListUser)
            <option value="{{$dataListUser}}">
        @endforeach
    </datalist>
   <label>Поиск</label>
    <input name="search" class="form-control" type="search" placeholder="Название или описание схемы" value="{{old('search')}}">


    Колличество записей на странице<input type="number" min="4" value="{{old('countOnPage',50)}}" name="countOnPage" class="form-control">
    <button type="submit"> Поиск</button>
    @csrf

</form>
