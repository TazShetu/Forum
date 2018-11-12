@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Channels</div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($channels as $channel)
                        <tr>
                            <td>{{$channel->title}}</td>
                            <td><a href="{{route('channels.edit', ['channel' => $channel->id])}}" class="btn btn-sm btn-info">Edit</a></td>
                            {{--route name and, value pass with which name, all r in route:list--}}
                            <td>
                                <form action="{{route('channels.destroy', ['channel' => $channel->id])}}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-danger btn-sm" type="submit">X</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
