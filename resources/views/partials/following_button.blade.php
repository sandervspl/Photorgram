@if(! Auth::Guest() && Auth::id() != $user->id)
    @if (Auth::User()->isFollowing($user->id))
        {!!
            Form::open([
                'action' => 'FollowController@unfollow',
                'class'  => 'horizontal-form followbutton'
            ])
        !!}

        {!! Form::hidden('follow_id', $user->id) !!}
        {!! Form::submit('Following', ['class' => 'btn btn-default profile-buttons following']) !!}

        {!! Form::close() !!}
    @else
        {!!
            Form::open([
                'action' => 'FollowController@follow',
                'class'  => 'horizontal-form followbutton'
            ])
        !!}

        {!! Form::hidden('follow_id', $user->id) !!}
        {!! Form::submit('Follow', ['class' => 'btn btn-default profile-buttons', 'id' => 'follow-button']) !!}

        {!! Form::close() !!}
    @endif
@endif