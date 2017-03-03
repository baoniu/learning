<!--- Title Field --->
<div class="form-group">
    {!! Form::label('title', '标题:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<!--- Body Field --->
<div class="form-group">
{{--    {!! Form::label('body', '内容:') !!}--}}
    <div class="editor">
        {!! Form::textarea('body', null, ['class' => 'form-control', 'id'=>'myEditor']) !!}
    </div>
</div>