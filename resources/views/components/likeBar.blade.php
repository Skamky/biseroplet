<ul class="list-group list-group-horizontal">
    <button class="@if($scheme->liked) active @endif list-group-item list-group-item-action"
            id="like{{$scheme->id_scheme}}"
            onclick="like('{{$scheme->id_scheme}}',1,'#like{{$scheme->id_scheme}}','#likeBar{{$scheme->id_scheme}}')">
        👍🏻
        <span class="badge bg-primary rounded-pill">{{$scheme->likes}}</span>
    </button>
    <button class="@if($scheme->disliked) active @endif list-group-item list-group-item-action"
            id="dislike{{$scheme->id_scheme}}"
            onclick="like('{{$scheme->id_scheme}}',-1,'#dislike{{$scheme->id_scheme}}','#likeBar{{$scheme->id_scheme}}')">
        👎🏻
        <span class="badge bg-primary rounded-pill">{{$scheme->dislikes}}</span>
    </button>
</ul>
