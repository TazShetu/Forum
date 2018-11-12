@extends('layouts.app')

@section('content')

    @foreach($discussions as $d)
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{asset($d->user->avatar)}}" alt="Img Not Working"  height="40px">&nbsp;&nbsp;&nbsp;
                <span>{{$d->user->name}}, <b>{{$d->created_at->diffforHumans()}}</b></span>
                @if($d->has_best_ans())
                    <span class="btn btn-success btn-sm pull-right">Closed</span>
                @else
                    <span class="btn btn-info btn-sm pull-right">Open</span>
                @endif
                <a href="{{route('discussion', ['slug' => $d->slug])}}" class="btn btn-default btn-sm pull-right" style="margin-right: 8px;">view</a>
            </div>
            <div class="panel-body">
                <h4 class="text-center">{{$d->title}}</h4>
                <p class="text-center">
                    {{str_limit($d->body, 150)}}
                </p>
            </div>
            <div class="panel-footer">
                <span>{{$d->replies->count()}} Replies</span>
                <a href="{{route('channels.show', ['channel' => $d->channel->slug])}}" class="btn btn-sm btn-default pull-right">{{$d->channel->title}}</a>
            </div>
        </div>
    @endforeach
    <div class="text-center">
        {{$discussions->links()}}
    </div>

@endsection
