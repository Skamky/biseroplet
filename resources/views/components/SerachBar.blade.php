<form  method="get" action="{{ route('search') }}" >
    <label>Сортировка</label>
    <div class="input-group">
        <div class="btn-group">
            <input type="radio" value="asc" {{ "asc" == optional($request)->orderBy2 ? ' checked' : '' }} class="btn-check" name="orderBy2" id="option1" autocomplete="off" title="Сортировка по возростанию"   >
            <label class="btn btn-outline-primary" for="option1" title="Сортировка по возростанию">⬆</label>

            <input type="radio" value="desc" {{ "desc" == optional($request)->orderBy2 ? ' checked' : '' }} class="btn-check" name="orderBy2" id="option2" autocomplete="off" title="Сортировка по убыванию">
            <label class="btn btn-outline-primary" for="option2" title="Сортировка по убыванию">⬇</label>
        </div>
        <select name="orderBy1" class="form-select" aria-label="Default select example">
                <option value="0" >По умолчанию</option>
                <option value="name_scheme" {{ "name_scheme" == optional($request)->orderBy1 ? ' selected' : '' }}>По названию</option>
                <option value="login"       {{ "login" == optional($request)->orderBy1 ? ' selected' : '' }}>По автору</option>
                <option value="created_at" {{ "created_at" == optional($request)->orderBy1 ? ' selected' : '' }}>По дате создания</option>
                <option value="updated_at" {{ "updated_at" == optional($request)->orderBy1 ? ' selected' : '' }}>По дате изменения</option>
        </select>
    </div>
    <label>Категория</label>
    <div class="input-group" title="Выберите 1 из вариантов">

        <select name="category" class="form-select" >
            <option value="0" >--Любая категория--</option>
            @foreach( $categories as $category)
                <option value="{{$category->id}}" {{ $category->id == optional($request)->category ? ' selected' : '' }}>{{$category->title}}</option>
            @endforeach
        </select>
    </div>
    <label>Автор</label>
    <input name="author" class="form-control" list="datalistAuthor" value="{{optional($request)->author}}">
    <datalist id="datalistAuthor">
        @foreach($dataListUsers as $dataListUser)
            <option value="{{$dataListUser}}">
        @endforeach
    </datalist>
   <label>Поиск</label>
    <input name="search"  type="search" placeholder="Название или описание схемы" value="{{optional($request)->search}}" class="form-control">


    <label> Колличество записей на странице </label>
        <input type="number" min="4" value="{{optional($request)->countOnPage}}" name="countOnPage" class="form-control" placeholder="По умолчанию или введите значение">
    <button type="submit" class="btn btn-outline-success"> Поиск</button>
    @csrf

</form>
