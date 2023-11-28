@extends("layouts.master")

@section('title',"Webhub Blogs")

@section("navbar")
@parent
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 mx-auto mt-4">
            <div class="card">
                <div class="card-header">
                    <h2>Add Blogs</h2>
                </div>
                <div class="card-body">
                    @if("success")
                       <div class="alert alert-success">{{ session("success") }}</div>
                    @endif
                    
                    <form action="{{ route("blogs.update",["id" => $blog->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input value="{{ $blog->title }}" type="text" name="title" id="title" placeholder="Title" class="form-control">
                        </div>
                        @error("title")
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" class="form-control" placeholder="Descriptions" rows="10">{{ $blog->body }}</textarea>
                        </div>
                        @error("body")
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" placeholder="Image" class="form-control">
                        </div>
                        @error("image")
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <button class="btn btn-dark" type="submit">Update Now</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection