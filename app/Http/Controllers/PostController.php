<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPosts = Post::with('user')->select('*')->get();
        return view('blog.index')->with('post' , $allPosts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     "title" => "required",
        //     "discription" => "required",
        //     "imge_path" => "required"
        // ]);
        $slug = Str::slug($request->title , '-');

        $title = $request['title'];
        $discription = $request['discription'];
        $userId = auth()->user()->id;



        $newImageName = uniqid() . '-' . $slug . '.' . $request->image->extension();
        $request->image->move(public_path('images') , $newImageName);

        $posts = new Post();

        $posts->title = $title;
        $posts->discription = $discription;
        $posts->slug = $slug;
        $posts->imge_path = $newImageName;
        $posts->user_id = $userId;

        $posts->save();

        // Post::create([
        //     "title" => $request['title'],
        //     "discription" => $request['discription'],
        //     "slug" => $slug,
        //     "imge_path" => $newImageName,
        //     "user_id" => auth()->user()->id
        // ]);

         return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $query = Post::with('user')->select('*')->where('slug' , $slug)->first();
        return view('blog.show')->with('showPost' , $query);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $showArticalIndex = Post::select('*')->where('id' , $id)->first();
        return view('blog.edit')->with('editeArtical' , $showArticalIndex);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title = $request['title'];
        $discription = $request['discription'];

        $slug = Str::slug($request->title , '-');
        $newImageName2 = uniqid() . '-' . $slug . '.' . $request->image->extension();
        $request->image->move(public_path('images') , $newImageName2);

        Post::where('id' , $id)->update([
            "title" => $title,
            "discription" => $discription,
            "slug" => $slug,
            "imge_path" => $newImageName2
        ]);

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request['id'];
        Post::where('id' , $id)->delete();
        return redirect()->back();
    }
}

