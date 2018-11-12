@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{route('reply.update', ['id' => $reply->id])}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="body">Edit the Reply</label>
                    <textarea name="body" id="content" cols="6" rows="6" class="form-control">{{$reply->body}}</textarea>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success pull-right" type="submit">Update Reply</button>
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
