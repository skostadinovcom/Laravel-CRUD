@extends('layouts.app')

@section('page_title', $post->title)
@section('page_description', str_limit($post->desc, $limit = 150, $end = '...'))
@section('page_author', '')
@section('current_page_managment', 'active')

@section('content')
    <div class="blog-post">
        <h2 class="blog-post-title">
            {{ $post->title  }}
        </h2>
        <p class="blog-post-meta">{{ $post->created_at->format('d F Y')  }} by <a>{{ $post->get_author->name }}</a></p>
        <img src="{{ asset('/uploads/posts/')  }}/{{ $post->image }}" width="100%" style="margin-bottom: 15px;">
        {!! $post->desc !!}
    </div><!-- /.blog-post -->
    <div class="blog-comments">
        <h3>Comments</h3>
        <div class="blog-comment-area">
            <div class="form-group">
                <label for="add_new_comment">Add new comment</label>
                <textarea class="form-control" id="add_new_comment" placeholder="" @if( Auth::guest() ) disabled="" @endif></textarea>
                @if( Auth::guest() )
                    <small class="form-text text-muted">To post a comment, first you need to login.</small>
                @endif
            </div>
            <button type="submit" @if( Auth::guest() ) disabled="" @endif class="btn btn-primary" id="add_comment" data-post="{{ $post->id  }}">Submit</button>
        </div>
        <div class="new_comments"></div>
        @if( count($comments) != 0 && count($comments) > 0 )
            @foreach( $comments as $comment )
                <div class="blog-comment">
                    <img src="{{ asset('/')  }}{{ $comment->get_author->image }}">
                    <a>{{ $comment->get_author->name  }}</a>
                    <p>{{ $comment->desc }}</p>
                    <div class="clear"></div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
