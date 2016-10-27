@if(Auth::Guest() || Auth::id() == $user->id)
    <?php $visibility = ' invisible'; ?>
@else
    <?php $visibility = ''; ?>
@endif

<div class="follow-button-inner">
    <div class="load-spinner follow hidden"></div>

    @if ( ! Auth::Guest() && Auth::User()->isFollowing($user->id))
        <button class="button follow-btn following{{ $visibility }}" data-followid="{{ $user->id }}">
            Following
        </button>
        <script>
            var followingsUrl = '{{ route('unfollow') }}',
                token = '{{ csrf_token() }}';
        </script>
    @else
        <button class="button follow-btn{{ $visibility }}" data-followid="{{ $user->id }}">
            + Follow
        </button>
        <script>
            var followingsUrl = '{{ route('follow') }}',
                token = '{{ csrf_token() }}';
        </script>
    @endif

    <script>
        var followUrl = '{{ route('follow') }}',
            unfollowUrl = '{{ route('unfollow') }}';
    </script>
</div>