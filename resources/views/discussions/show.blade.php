@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{asset($discussion->user->avatar)}}" alt="Img Not Working"  height="40px">&nbsp;&nbsp;&nbsp;
            <span>{{$discussion->user->name}}, <b>({{$discussion->user->points}})</b></span>
            @if($discussion->has_best_ans())
                <span class="btn btn-success btn-sm pull-right">Closed</span>
            @else
                <span class="btn btn-info btn-sm pull-right">Open</span>
            @endif
            {{----}}
            @if(Auth::id() == $discussion->user_id && !$discussion->has_best_ans())
                <a href="{{route('discussion.edit', ['slug' => $discussion->slug])}}" class="btn btn-warning btn-sm pull-right" style="margin-right: 8px;">Edit</a>
            @endif
            {{----}}
            @if(Auth::check())
                @if($discussion->being_watched())
                    {{--must code being_watched() in $discussion--}}
                    <a href="{{route('Dunwatch', ['id' => $discussion->id])}}" class="btn btn-default btn-sm pull-right" style="margin-right: 8px;">Don't Update anymore</a>
                @else
                    <a href="{{route('Dwatch', ['id' => $discussion->id])}}" class="btn btn-default btn-sm pull-right" style="margin-right: 8px;">Update Me</a>
                @endif
            @endif
        </div>
        <div class="panel-body">
            <h4 class="text-center">{{$discussion->title}}</h4>
            <hr>
            <p class="text-center">
                {{$discussion->body}}
            </p>
            <hr>

            @if($best_reply)
                <div class="text-center" style="padding: 35px;">
                    <h4 class="text-center">Best Answer</h4>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <img src="{{asset($best_reply->user->avatar)}}" alt="Img Not Working"  height="40px">&nbsp;&nbsp;&nbsp;
                            <span>{{$best_reply->user->name}} <b>({{$best_reply->user->points}})</b></span>
                        </div>
                        <div class="panel-body">
                            {{$best_reply->body}}
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <div class="panel-footer">
            <span>{{$discussion->replies->count()}} Replies</span>
            <a href="{{route('channels.show', ['channel' => $discussion->channel->slug])}}" class="btn btn-sm btn-default pull-right">{{$discussion->channel->title}}</a>
        </div>
    </div>

    @foreach($discussion->replies as $r)
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{asset($r->user->avatar)}}" alt="Img Not Working"  height="40px">&nbsp;&nbsp;&nbsp;
                <span>{{$r->user->name}} <b>({{$r->user->points}})</b>, &nbsp;{{$r->created_at->diffforHumans()}}</span>
                {{----}}
                @if($r->discussion->user_id == Auth::id())
                    @if($best_reply)
                        @if($best_reply->id !== $r->id)
                            <a href="{{route('discussion.best.ans', ['rid' => $r->id, 'did' => $r->discussion->id])}}" class="btn bg-info btn-sm pull-right" style="margin-left: 7px;">Mark as best Answer</a>
                        @endif
                    @else
                        <a href="{{route('discussion.best.ans', ['rid' => $r->id, 'did' => $r->discussion->id])}}" class="btn bg-info btn-sm pull-right" style="margin-left: 7px;">Mark as best Answer</a>
                    @endif
                @endif
                {{----}}
                @if($r->user_id == Auth::id())
                    @if($r->best_ans == 0)
                        <a href="{{route('reply.edit', ['id' => $r->id])}}" class="btn btn-warning btn-sm pull-right">Edit</a>
                    @endif
                @endif


            </div>
            <div class="panel-body">
                <p class="text-center">
                    {{$r->body}}
                </p>
            </div>
            <div class="panel-footer">
                @if($r->is_like())
                    {{--create this method is_like() in Reply.php--}}
                    <a href="{{route('reply.unlike', ['id' => $r->id])}}" class="btn btn-info btn-sm">Recall Like <span class="badge">{{$r->likes->count()}}</span></a>
                @else
                    <a href="{{route('reply.like', ['id' => $r->id])}}" class="btn btn-success btn-sm">Like <span class="badge">{{$r->likes->count()}}</span></a>
                @endif
            </div>
        </div>
    @endforeach

    <div class="panel panel-default">
        <div class="panel-body">
            @if(Auth::check())
                <form action="{{route('discussion.reply', ['id' => $discussion->id])}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="reply">Leave a reply...</label>
                        <textarea name="reply" id="reply" cols="5" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn pull-right btn-info" type="submit">Leave a reply</button>
                    </div>
                </form>
            @else
                <form>
                    <div class="form-group">
                        <label for="reply">Leave a reply...</label>
                        <textarea name="reply" id="reply" cols="5" rows="5" class="form-control">Sign in to leave a reply</textarea>
                    </div>
                </form>
            @endif
        </div>
    </div>

@endsection
