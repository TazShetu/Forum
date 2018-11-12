@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Edit Channel: {{$channel->title}}</div>

        <div class="panel-body">
            <form action="{{route('channels.update', ['channel' => $channel->id])}}" method="post">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="channel" value="{{$channel->title}}">
                    {{--name="channel"--}}
                </div>


                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
