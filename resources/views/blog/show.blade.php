<!-- Page Content -->
@extends('layouts.main')
@section('title', $post->title)
@section('description', $post->excerpt_html )
@section('keywords', 'sharing, sharing text, text, sharing blog, blogs,')
@section('revisit-after', 'content="3 days')

@section('content')
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8 mt-4">

        <!-- Preview Image -->
		@if($post->imageUrl)
        <img class="img-fluid rounded" src="{{ $post->imageUrl }}" alt="{{ $post->title }}">
		@endif
                    
		<!-- Title -->
        <h1 class="mt-4">{{ $post->title }}</h1>

        <!-- Author -->
        <p class="lead">
          by
          <i class="fa fa-user"></i><a href="{{ route('author',$post->author->slug) }}"> {{ $post->author->name }} </a> Posted on <i class="fa fa-clock-o"></i><time> {{ $post->date }} </time> <i class="fa fa-folder"></i><a href="{{ route('category', $post->category->slug) }}"> {{ $post->category->title }}</a> 
        </p>
		
        <hr>

        <!-- Post Content -->
        {!! htmlspecialchars_decode($post->body_html) !!}
		<hr>
		<p>
        @foreach($post->tags as $tag )
            <i class="fa fa-tag"></i><a href="{{ route('tag', $tag->slug) }}"> {{ $tag->name }}</a> &nbsp;
        @endforeach
        </p>
        <hr>
		<article class="post-author padding-10">
                    <div class="media">
                      <div class="media-left">
                        <a href=" {{ route('author', $post->author->slug) }} ">
                          <img alt=" {{ $post->author->name }} " width="100" height="100" src="{{ $post->author->gravatar() }}" class="media-object">
                        </a>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading"><a href="{{ route('author',$post->author->slug) }}"> {{ $post->author->name }} </a></h4>
                        <div class="post-author-count">
                          <a href="{{ route('author',$post->author->slug) }}">
                              <i class="fa fa-clone"></i>
                              <?php $postCount= $post->author->post()->published()->count() ?>
                              {{ $postCount }} {{ str_plural('post', $postCount) }}
                          </a>
                        </div>
                        {!! $post->author->bio_html !!}
                      </div>
                    </div>
        </article>
		<hr>		

        
      </div>
	  @include('layouts.sidebar')
      <!-- Sidebar Widgets Column -->

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
  @endsection




