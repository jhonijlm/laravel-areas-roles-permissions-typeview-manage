<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    //

    public function index(){
        $this->authorize("hasPermission", [Str::remove('/', Request()->route()->getPrefix()), "posts", "index"]);
        $posts = Post::where("status", 1)->with("user");

        $isAccess = false;
        if(Auth::user()->hasPermission(Str::remove('/', Request()->route()->getPrefix()), "posts", "list", "partial")){
            $posts->where("user_id", Auth::id());
            $isAccess = true;
        }else if(Auth::user()->hasPermission(Str::remove('/', Request()->route()->getPrefix()), "posts", "list", "total")){
            $isAccess = true;
        }

        if($isAccess){

            return view(Str::remove('/', Request()->route()->getPrefix()).".posts.index")->with([
                "posts" => $posts->paginate(10)->onEachSide(2)
            ]);;
        }else{
            abort(403);
        }

    }

    public function create(){
        $this->authorize('hasPermission', [Str::remove('/', Request()->route()->getPrefix()), 'posts', "create"]);
        return view(Str::remove('/', Request()->route()->getPrefix()).".posts.create");
    }

    public function store(PostRequest $request){
        $this->authorize('hasPermission', [Str::remove('/', Request()->route()->getPrefix()), 'posts', "create"]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->status = 1;
        $post->user_id = Auth::check() ? Auth::id() : null;
        $post->save();

        return redirect()->route(Str::remove('/', Request()->route()->getPrefix()).".posts.index");
    }

    public function edit($id){
        $post = Post::where(["id" => $id, "status" => 1])->first();

        if($post){
            $this->authorize('get', [$post , [Str::remove('/', Request()->route()->getPrefix()), "posts", "get"]]);
            return view(Str::remove('/', Request()->route()->getPrefix()).".posts.edit", compact('post'));
        }else{
            abort(404);
        }
    }

    public function update(PostRequest $request, $id){
        $post = Post::where(["id" => $id, "status" => 1])->first();
        $this->authorize('update', [$post , [Str::remove('/', Request()->route()->getPrefix()), "posts", "update"]]);

        if($post){
            $post->title = $request->title;
            $post->content = $request->content;
            $post->user_updated_id = Auth::check() ? Auth::id() : null;
            $post->save();
            return redirect()->route(Str::remove('/', Request()->route()->getPrefix()).".posts.index");
        }else{
            abort(404);
        }
    }

    public function delete($id){
        $role = Post::where(["id" => $id, "status" => 1])->first();

        if($role){
            $this->authorize('delete', [$role , [Str::remove('/', Request()->route()->getPrefix()), "posts", "delete"]]);
        }else{
            abort(404);
        }

        $role->status = 2;
        $role->user_deleted_id = Auth::check() ? Auth::id() : null;
        $role->deleted_at = Carbon::now();
        $role->save();

        return redirect()->route(Str::remove('/', Request()->route()->getPrefix()).".posts.index");
    }
}
