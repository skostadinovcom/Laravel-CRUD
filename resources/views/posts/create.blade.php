@extends('layouts.app')

@section('page_title', 'Create new')
@section('page_description', Config::get('settings.site_desc'))
@section('page_author', '')
@section('current_page_managment', 'active')

@section('content')
    <div class="blog-post">
        <h2 class="blog-post-title">
            Create new
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
            <form enctype="multipart/form-data" method="post" action="/posts/">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="post_title">Title</label>
                    <input type="text" class="form-control" id="post_title" name="title">
                </div>
                <div class="form-group">
                    <label for="post_content">Content</label>
                    <textarea class="form-control" id="post_content" style="height: 250px;" name="desc"></textarea>
                </div>
                <div class="form-group">
                    <label for="post_image">Image</label>
                    <input type="file" class="form-control" id="post_image" name="image">
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" checked="" name="publish">
                        Publish now
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
