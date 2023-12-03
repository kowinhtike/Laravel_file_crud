@extends("layouts.master")

@section("navbar")
@parent
@endsection

@section('content')
<div class="container">
    <div class="d-flex flex-column justify-content-center align-items-center h-100">
        <h1>404 Not Found</h1>
        <br>
        <p>This url path is wrong. please try again?</p>
        <a href="/" class="btn btn-dark">Go Back Home</a>
    </div>
</div>
@endsection

