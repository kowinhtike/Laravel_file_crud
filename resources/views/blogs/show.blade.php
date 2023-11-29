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

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Comments</h1>
                        @foreach ($comments as $comment)
                            <div class="alert alert-info">{{ $comment->comments }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <form action="{{ route("blogs.comment",["id"=>$blog->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="cmt">Add Comment</label>
                    <textarea name="comment" class="form-control" id="cmt"  rows="5"></textarea>
                </div>
                <button class="btn btn-dark mb-3" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection