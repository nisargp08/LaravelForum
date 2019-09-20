@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="#"><b>{{$thread->author->name}}</b></a> posted : {{$thread->title}}</div>

                <div class="card-body">
                    <article>
                        <div class="body">{{ $thread->body }}</div>
                    </article>
                </div>
            </div>
        </div>
    </div><hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
                @foreach ($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
        </div>
    </div>
    @if (auth()->check())
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="font-weight-bold">{{ Auth()->user()->name }}</div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ $thread->path().'/replies' }}">
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
