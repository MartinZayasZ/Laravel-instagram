@if( Auth::user()->image )
<div class="container-avatar">
    <img src="{{ route('user.avatar', ['filename'=> Auth::user()->image]) }}" alt="Avatar" class="avatar">
</div>
@endif
