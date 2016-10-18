@if(Auth::Guest() || Auth::id() == $user->id)
    <?php $visibility = ' invisible'; ?>
@else
    <?php $visibility = ''; ?>
@endif

@if ( ! Auth::Guest() && Auth::User()->isFollowing($user->id))
    {!!
        Form::open([
            'action' => 'FollowController@unfollow',
            'class'  => 'horizontal-form follow-button-form'
        ])
    !!}

    {!! Form::hidden('follow_id', $user->id) !!}
    {!! Form::submit('Following', ['class' => 'button profile-buttons follow-btn following'.$visibility]) !!}

    {!! Form::close() !!}
@else
    {!!
        Form::open([
            'action' => 'FollowController@follow',
            'class'  => 'horizontal-form follow-button-form'
        ])
    !!}

    {!! Form::hidden('follow_id', $user->id) !!}
    {!! Form::submit('Follow', ['class' => 'button profile-buttons follow-btn'.$visibility, 'id' => 'follow-button']) !!}

    {!! Form::close() !!}
@endif