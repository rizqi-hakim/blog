<?php

namespace App\Http\Controllers\Dashboard;

use App\Service\BaseService;
use Cviebrock\EloquentSluggable\Services\SlugService;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardPostController extends Controller
{
    protected $baseService;

    public function __construct()
    {
        $this->baseService = new BaseService();
    }

    public function index()
    {
        $userlogin = $this->baseService->getUserLogin();

        $posts = Post::where('user_id', $userlogin->id)->get();

        return view('dashboard.posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.posts.create', [
            'categories' => $categories
        ]);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function store(Request $request)
    {
        $userlogin = $this->baseService->getUserLogin();

        $validateInput = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);

        if ($request->file('image')) {
            $validateInput['image'] = Cloudinary::upload($request->file('image')->getRealPath(),[
                'folder' => 'Posts'
            ])->getSecurePath();
        }

        $validateInput['user_id'] = $userlogin->id;
        $validateInput['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::create($validateInput);

        return redirect(route('DPosts.index'))->with(['success' => 'New post has been added!']);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $userlogin = $this->baseService->getUserLogin();

        $rules = [
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug,'.$post->id,
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        // if ($request->slug != $post->slug) {
        //     $rules['slug'] = 'required|unique:posts';
        // }

        $validateInput = $request->validate($rules);

        if ($request->file('image')) {
            if ($post->image) {
                $urlImage = $post->image;
                preg_match("/upload\/(?:v\d+\/)?([^\.]+)/", $urlImage, $matches);
                $imgName = $matches[1];
                Cloudinary::destroy($imgName);
            }

            $validateInput['image'] = Cloudinary::upload($request->file('image')->getRealPath(),[
                'folder' => 'Posts'
            ])->getSecurePath();
        }

        $validateInput['user_id'] = $userlogin->id;
        $validateInput['excerpt'] = Str::limit(strip_tags($request->body), 200);

        $post->update($validateInput);

        return redirect(route('DPosts.index'))->with(['success' => 'Post has been updated!']);
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            $urlImage = $post->image;
            preg_match("/upload\/(?:v\d+\/)?([^\.]+)/", $urlImage, $matches);
            $imgName = $matches[1];
            Cloudinary::destroy($imgName);
        }
        
        $post->delete();

        return redirect(route('DPosts.index'))->with(['success' => 'Post has been deleted!']);
    }
}
