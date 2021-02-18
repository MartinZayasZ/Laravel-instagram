@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('includes.message')

            @foreach( $images as $image )
                <div class="card pub-image">
                    <div class="card-header">
                        @if( $image->user->image )
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar', ['filename'=> $image->user->image ]) }}" alt="Avatar" class="avatar">
                            </div>
                        @endif
                        <div class="data-user">
                            <a href="{{ route('image.detail', ['id' => $image->id]) }}">
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
                            <p>{{ $image->description }}</p>
                        </div>
                        <div class="likes">
                            <img src="{{ asset('img/hearts-gray.ico') }}" alt="heart">
                        </div>
                        <div class="comments">
                            <a href="" class="btn btn-warning btn-sm btn-comments">
                                Comentarios ({{ count($image->comments) }})
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach

            <!-- Paginación -->
            <div class="clearfix"></div>
            {{ $images->links() }}

        </div>


    </div>
</div>
@endsection
