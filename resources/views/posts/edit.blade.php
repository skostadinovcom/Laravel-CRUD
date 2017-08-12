@extends('layouts.app')

@section('page_title', 'Edit: ' . $post->title)
@section('page_description', Config::get('settings.site_desc'))
@section('page_author', '')
@section('current_page_managment', 'active')

@section('content')
    <div class="blog-post">
        <h2 class="blog-post-title">
            Edit Post
        </h2>
        <div class="edit" style="margin-top: 25px;">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin: 0; padding: 0; margin-left: 10px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form enctype="multipart/form-data" method="post" action="/posts/{{ $post->id  }}/" style="display: inline;">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="post_title">Title</label>
                    <input type="text" class="form-control" id="post_title" value="{{ $post->title  }}" name="title">
                </div>
                <div class="form-group">
                    <label for="post_content">Content</label>
                    <textarea class="form-control" id="post_content" style="height: 250px;" name="desc">{{ $post->desc  }}</textarea>
                </div>
                <div class="form-group">
                    <label for="post_image">Image</label>
                    <div class="image">
                        <img src="{{ asset('/uploads/posts/')  }}/{{ $post->image  }}" style="width: auto;">
                    </div>
                    <input type="file" class="form-control" id="post_image" name="image">
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" @if( $post->publish == 1 ) checked="" @endif name="publish">
                        Publish now
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <form enctype="multipart/form-data" method="POST" action="/posts/{{ $post->id  }}" style="display: inline;" id="delete_post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection
