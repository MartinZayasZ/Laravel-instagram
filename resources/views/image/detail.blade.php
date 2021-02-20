@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @include('includes.message')

            <div class="card pub-image pub-image-detail">
                <div class="card-header">
                    @if( $image->user->image )
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar', ['filename'=> $image->user->image ]) }}" alt="Avatar" class="avatar">
                        </div>
                    @endif
                    <div class="data-user">
                        {{ $image->user->name . ' ' . $image->user->surname }}
                        <span class="nickname">| {{'@'.$image->user->nick}}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="image-container image-detail">
                        <img src="{{ route('image.file',['filename' => $image->image_path]) }}" alt="">
                    </div>
                    <div class="description">
                        <span class="date">{{ \FormatTime::LongTimeFilter($image->created_at) }}</span>
                        <p>{{ $image->description }}</p>
                    </div>
                    <div class="likes">
                        <img src="{{ asset('img/hearts-gray.ico') }}" alt="heart">
                    </div>
                    <div class="clearfix"></div>
                    <div class="comments">
                        <h2> Comentarios ({{ count($image->comments) }})</h2>
                        <hr>

                        <form method="POST" action="{{ route('comment.save') }}">
                            @csrf
                            <input type="hidden" name="image_id" value="{{ $image->id }}">

                            <p>
                                <textarea name="content" class="form-control  @error('content') is-invalid @enderror" cols="30" rows="5"></textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                                @enderror
                            </p>

                            <button type="submit" class="btn btn-success">Guardar</button>

                        </form>

                        <hr>

                        @foreach( $image->comments as $comment )
                            <div class="comment">
                                <span class="nickname">{{'@'.$image->user->nick}} |</span>
                                <span class="date">{{ \FormatTime::LongTimeFilter($comment->created_at) }}</span>
                                <p>{{ $comment->content }}</p>

                                @if ( Auth::check() &&  ( $comment->user->id == Auth::user()->id || $image->user_id == Auth::user()->id ) )
                                    <br>
                                    <a class="btn btn-sm btn-danger" href="{{ route('comment.delete',['id' => $comment->id]) }}">Eliminar</a>
                                @endif

                            </div>
                        @endforeach

                    </div>

                </div>
            </div>

        </div>


    </div>
</div>
@endsection
