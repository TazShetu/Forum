@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Create Channel</div>

        <div class="panel-body">
            <form action="{{route('channels.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="channel">
                    {{--name="channel"--}}
                </div>


                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
