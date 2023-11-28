@extends("layouts.master")

@section('title',"Webhub Blogs")

@section("navbar")
@parent
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>{{ $blog->title }}</h1>
            <img src="{{ asset("/images"."/".$blog->image_url) }}" width="400px" alt="">
            <p class="text-justify">{{ $blog->body }}</p>
            <br>
            <br>
            <p>Date</p>
            <strong>{{ Carbon\Carbon::parse($blog->created_at)->format("d/m/Y") }}</strong>
            <br><br>
            <a href="{{ route("blogs.edit",["id" => $blog->id]) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route("blogs.destroy",["id" => $blog->id]) }}" class="btn btn-danger">Delete</a>
        </div>
    </div>
</div>
@endsection