@extends('layouts.master')
@section('title', 'Edit')
@section('content')
    <section class="main-article">
        <h1>Profile Settings</h1>

        @if($user->id != Auth::id())
            <div class="warning-box">
                <span>You are now editing the account/profile settings of: <b>{{ $user->name }}</b></span>
            </div>
        @endif

        @include('partials/edit_account_menu')

        {!!
            Form::open([
                'action' => 'ProfileController@update',
                'files'  => true,
                'class'  => 'form-horizontal'
            ])
        !!}

        <div class="form-group">
            {!! Form::label('image', 'Profile Picture', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
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

        {!! Form::hidden('user_id', $user->id) !!}

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </section>
@endsection