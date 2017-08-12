@extends('layouts.app')

@section('page_title', 'Home')
@section('page_description', Config::get('settings.site_desc'))
@section('page_author', '')
@section('current_page_home', 'active')

@section('content')
    @if( count($posts) != 0 && count($posts) > 0 )
        @foreach( $posts as $post )
            <div class="blog-post">
                <h2 class="blog-post-title" style="font-size: 30px;">
                    <a href="/posts/{{ $post->id  }}">{{ $post->title  }}</a>
                </h2>
                <p class="blog-post-meta">{{ $post->created_at->format('d F Y')  }}, by <a>{{ $post->get_author->name }}</a></p>
                <p>
                    {{ strip_tags(str_limit($post->desc, $limit = 250, $end = '...')) }} <a href="/posts/{{ $post->id  }}">Read more...</a>
                </p>
            </div>
        @endforeach
    @else
        <div class="alert alert-dark">
            No posts.
        </div>
    @endif
@endsection
