@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">Edit the Discussion Content</div>

        <div class="panel-body">
            <form action="{{route('discussion.update', ['id' => $discussion->id])}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="body">Ask a question</label>
                    <textarea name="body" id="content" cols="6" rows="19" class="form-control">{{$discussion->body}}</textarea>
                </div>


                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success pull-right" type="submit">Update discussion Content</button>
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
