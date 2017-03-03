@extends('app')

@section('content')
    @include('editor::head')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1" role="main">
                {!! Form::model($discussion,['url'=>'/discussions/' . $discussion->id, 'method'=>'PATCH']) !!}
                @include('forum.form')
                <div>
                    {!! Form::submit('更新帖子', ['class'=>'btn btn-primary pull-right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop