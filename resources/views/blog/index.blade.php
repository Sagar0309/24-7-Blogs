@extends('layouts.main') @section('content')
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8 mt-4">
            <!-- Blog Post -->
            @include('blog.alert') @foreach($posts as $post)
            <div class="card mb-4">
                @if($post->imageUrl)
                <a href="{{ route('frontend.blog.show',$post->slug) }}">
                    <img class="card-img-top" src="{{ asset($post->imageUrl) }}" alt="" />
                </a>
                @endif
                <div class="card-body">
                    <h2 class="card-title"><a href="{{ route('frontend.blog.show',$post->slug) }}">{{ $post->title }}</a></h2>
                    <p class="card-text">{!! $post->excerpt_html !!}</p>
                    <a href="{{ route('frontend.blog.show',$post->slug) }}" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    <i class="fa fa-folder"></i><a href="{{ route('category', $post->category->slug) }}"> {{ $post->category->title }} </a> Posted on {{ $post->date }} by <i class="fa fa-user"></i>
                    <a href="{{ route('author', $post->author->slug) }}">{{ $post->author->name }}</a>
                </div>
            </div>
            @endforeach
            <!-- Pagination -->
            <ul class="pagination justify-content-center mb-4">
                {{ $posts->appends(request()->only(['term']))->links() }}
            </ul>
        </div>
        @include('layouts.sidebar')
    </div>
</div>
@endsection
