<div class="card pub-image">
    <div class="card-header">
        @if( $image->user->image )
            <div class="container-avatar">
                <img src="{{ route('user.avatar', ['filename'=> $image->user->image ]) }}" alt="Avatar" class="avatar">
            </div>
        @endif
        <div class="data-user">
            <a href="{{ route('user.profile', ['id' => $image->user->id]) }}">
                {{ $image->user->name . ' ' . $image->user->surname }}
                <span class="nickname">| {{'@'.$image->user->nick}}</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="image-container">
            <img src="{{ route('image.file',['filename' => $image->image_path]) }}" alt="">
        </div>
        <div class="description">
            <span class="date">{{ \FormatTime::LongTimeFilter($image->created_at) }}</span>
            <p>{{ $image->description }}</p>
        </div>
        <div class="likes">

            <?php $user_like = false; ?>
            @foreach( $image->likes as $like)
                @if( $like->user->id == Auth::user()->id)
                    <?php $user_like = true; ?>
                @endif
            @endforeach

            @if ($user_like)
                <img src="{{ asset('img/hearts-red.ico') }}" data-id="{{ $image->id }}" alt="heart" class="btn-dislike">
            @else
                <img src="{{ asset('img/hearts-gray.ico') }}" data-id="{{ $image->id }}" alt="heart" class="btn-like">
            @endif

            <span class="count-likes">{{ count($image->likes) }}</span>


        </div>
        <div class="comments">
            <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="btn btn-warning btn-sm btn-comments">
                Comentarios ({{ count($image->comments) }})
            </a>
        </div>

    </div>
</div>
