@extends('layouts.app')

@section('page_title', 'Managment List')
@section('page_description', Config::get('settings.site_desc'))
@section('page_author', '')
@section('current_page_managment', 'active')

@section('content')
    <div class="blog-post">
        <h2 class="blog-post-title float-left">
            Managment Posts
        </h2>
        <a href="/posts/create/" class="btn btn-outline-info float-right">Add new post</a>
        <div class="clear"></div>
        @if( count($posts) != 0 && count($posts) > 0 )
        <table class="table table-striped" style="margin-top: 25px;">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach( $posts as $post )
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $post->title  }}</td>
                        <td>{{ $post->get_author->name  }}</td>
                        <td>{{ $post->created_at->format('d F Y')  }}</td>
                        <td>
                            <a href="/posts/{{ $post->id  }}">Preview</a>
                            <a href="/posts/{{ $post->id }}/edit">Edit</a>
                            <a href="/posts/{{ $post->id  }}/edit/#delete_post" class="red">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="alert alert-dark">
                No posts.
            </div>
        @endif
    </div>
@endsection
