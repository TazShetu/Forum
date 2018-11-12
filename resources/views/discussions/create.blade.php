@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">Create a new discussion</div>

        <div class="panel-body">
            <form action="{{route('discussion.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label for="Pick a channel">Pick a channel</label>
                    <select name="channel_id" id="chanel_id" class="form-control">
                        @foreach($channels as $channel)
                            <option value="{{$channel->id}}">{{$channel->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="body">Ask a question</label>
                    <textarea name="body" id="content" cols="5" rows="5" class="form-control">{{old('body')}}</textarea>
                </div>


                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success pull-right" type="submit">Create discussion</button>
                    </div>
                </div>
            </form>
        </div>
        @if(count($errors) > 0)
            <ul class="list-group">
                @foreach($errors->all() as $error)
                    <li class="list-group-item text-danger">
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

@endsection
