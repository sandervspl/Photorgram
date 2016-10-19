@if(Auth::Guest() || Auth::id() == $user->id)
    <?php $visibility = ' invisible'; ?>
@else
    <?php $visibility = ''; ?>
@endif

<div class="follow-button-container">
@if ( ! Auth::Guest() && Auth::User()->isFollowing($user->id))
    <button class="button profile-buttons follow-btn following{{ $visibility }}" data-followid="{{ $user->id }}">Following</button>
    <script>
        var url = '{{ route('unfollow') }}',
            token = '{{ csrf_token() }}';
    </script>
@else
    <button class="button profile-buttons follow-btn{{ $visibility }}" data-followid="{{ $user->id }}">Follow</button>
    <script>
        var url = '{{ route('follow') }}',
            token = '{{ csrf_token() }}';
    </script>
@endif
</div>
<script>
    var followUrl = '{{ route('follow') }}',
        unfollowUrl = '{{ route('unfollow') }}';
</script>