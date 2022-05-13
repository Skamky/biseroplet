<form class="m-3 border p-3" style="width: 70%; position: absolute; left: 50%; transform: translate(-50%)">
    <p>Сортировка по</p>
    <div class="hstack gap-3" style="display: flex; flex-direction: row" >
            <select class="form-select" aria-label="Default select example" style="width: 30%">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        <button class="btn" title="Сортиро">⬆</button>
           <button class="btn">⬇</button>

    </div>
        <p>Отображать только</p>
        <select class="form-select" name="filter">
            <option value="1">Кольцо</option>
            <option value="2">Браслет</option>
        </select>
    Поиск
    <input type="search">
    <button type="submit"></button>
</form>
