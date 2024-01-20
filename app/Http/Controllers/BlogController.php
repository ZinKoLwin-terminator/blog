<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs.index', [
            'blogs' => Blog::latest()
                ->filter(request(['search', 'category', 'username']))
                ->paginate(10)
                ->withQueryString()
        ]);
    }
    function  show(Blog $blog)
    {
        return view('blogs.show', [
            'blog' => $blog,
            'randomBlogs' => Blog::inRandomOrder()->take(3)->get()
        ]);
    }

    // protected function getBlogs()
    // {
    //     return  Blog::latest()->filter()->get();
    //     // $query = Blog::latest();

    //     // $query->when(request('search'), function ($query, $search) {
    //     //     $query->where('title', 'LIKE', '%' . $search . '%')
    //     //         ->orWhere('body', 'LIKE', '%' . $search . '%');
    //     // });
    //     // return $query->get();

    // }

    public function subscriptionHandler(Blog $blog)
    {
        if (User::find(auth()->id())->isSubscribed($blog)) {
            $blog->unSubscribe();
        } else {
            $blog->subscribe();
        }

        return back();
    }

    public function create()
    {
        return view('blogs.create', [
            'categories' => Category::all()
        ]);
    }

    public function store()
    {
        // request()->file('thumbnail')->store('thumbnails');
        // return 'done';

        $formData = request()->validate([
            "title" => ["required"],
            "slug" => ["required", Rule::unique('blogs', 'slug')],
            "intro" => ["required"],
            "body" => ["required"],
            "category_id" => ["required", Rule::exists('categories', 'id')],


        ]);

        $formData['user_id'] = auth()->id();
        $formData['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Blog::create($formData);

        return redirect('/');
    }
}
