<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
class BlogController extends Controller
{
    //

    public function index(){
        $blogs = Blog::paginate(3);

        return view("blogs.index",["blogs" => $blogs]);
    }
    public function show($id){
        $blog = Blog::find($id);
        return view("blogs.show",["blog" => $blog]);
    }
    public function create(){
        return view("blogs.create");
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:3|max:10000',
            'image' => 'required',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->body = $request->body;
        $image = $request->file('image');
        $imgName = $image->hashName();
        $image->storeAs('images',$imgName);
        $blog->image_url = $imgName;
        $blog->save();

        return back()->with('success',"Blog create successfully");

    }
    public function edit($id){
        $blog = Blog::find($id);
        return view("blogs.edit",["blog" => $blog]);
    }
    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:3|max:10000',
        ]);
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->body = $request->body;
        if($request->file('image')){
            //delete the previous image storage
            Storage::delete("images/".$blog->image_url);
            $image = $request->file('image');
            $imgName = $image->hashName();
            $image->storeAs('images',$imgName);
            $blog->image_url = $imgName;
        }
        $blog->save();
        return to_route("blogs.index")->with('success',"Blog updated successfully");
    }
    public function destroy($id){
        $blog = Blog::where("id",$id)->first();
        Storage::delete("images/".$blog->image_url);
        $blog->delete();
        return to_route("blogs.index")->with('success',"Blog deleted successfully");
    }
}
