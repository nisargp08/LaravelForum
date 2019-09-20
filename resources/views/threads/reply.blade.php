<div class="card mb-2">
        <div class="card-header"><a href="#"><b>{{$reply->user->name}}</b></a> said {{ $reply->created_at->diffForHumans() }}</div>
        <div class="card-body">
            <article>
                <div class="body">{{ $reply->body }}</div>
            </article>
        </div>
    </div>
