<?php $user = Auth::user() ?>
@extends('layouts.master')
@section('title', 'Edit')
@section('content')
    <section class="main-article">
        <div class="profile-header">
            <h1>Profile Settings</h1>

            @include('partials/edit_account_menu')

            {!! Form::open([
                    'action' => 'ProfileController@update',
                    'class' => 'form-horizontal'
                ])
            !!}

            <div class="form-group">
                {!! Form::label('image', 'Profile Picture', ['class' => 'col-sm-2 control-label']) !!}
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
                {!! Form::label('bio', 'Bio', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('bio', $user->profile->bio, ['class' => 'form-control']) !!}
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </section>
@endsection