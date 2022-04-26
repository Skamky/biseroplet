@extends('layouts.app')
@section('content')
    <div class="alert alert-info alert-dismissible " role="alert">
Здесь будут представлены примеры схемы созданные в генераторе..
    </div>
    <button type="button"  class="btn btn-secondary" onclick="showModal()">
        Click to launch modal
    </button>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div id="myModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Подтверждение</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="closeModal()">×</button>
                </div>
                <div class="modal-body">
                    <p>Вы хотите сохранить изменения в этом документе перед закрытием?</p>
                    <p class="text-secondary"><small>Если вы не сохраните, ваши изменения будут потеряны.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Закрыть</button>
                    <button type="button" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>
<script>
    function showModal(){
        $("#myModal").modal('show');
    }
    function closeModal()
    {
        $("#myModal").modal('hide');
    }
</script>
@endsection
