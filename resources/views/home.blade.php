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
                            {{ $image->user->name . ' ' . $image->user->surname }}
                            <span class="nickname">| {{'@'.$image->user->nick}}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{ route('image.file',['filename' => $image->image_path]) }}" alt="">
                        </div>
                        <div class="likes"></div>
                        <div class="description">
                            <p>{{ $image->description }}</p>
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
