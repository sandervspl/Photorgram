@extends('layouts.master')
@section('title', 'Upload')
@section('content')
<section class="main-article">
    <h1>Upload New Image</h1>

    <div class="upload-form">
    {!! Form::open([
            'action' => 'ImageController@process',
            'files'  => true,
            'class'  => 'form-horizontal'
        ])
    !!}

        <div class="form-group">
            {!! Form::label('image', 'Upload Image*', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::file(
                        'image',
                        null,
                        [
                            'class'    => 'form-control input-sm',
                            'required' => 'required'
                        ]
                    )
                 !!}
            </div>
        </div>


        <div class="form-group">
            {!! Form::label('category', 'Category*', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::select(
                        'category',
                        [
                            'comics' => 'Comics',
                            'nature' => 'Nature',
                            'music'  => 'Music',
                            'meme'   => 'Meme',
                            'funny'  => 'Funny'
                        ],
                        null,
                        [
                            'class'       => 'form control input-sm',
                            'placeholder' => 'Pick a category...',
                            'required'    => 'required'
                        ]
                    )
                !!}
            </div>
        </div>


        <div class="form-group">
            {!! Form::label('title', 'Title*', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>


        <div class="form-group">
            {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Upload Image', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}
    </div>
</section>
@endsection