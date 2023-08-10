<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        //latest post
      $latestPost=Post::where('active','=',1)
                      ->whereDate('published_at','<',Carbon::now())
                      ->orderBy('published_at','Desc')
                      ->Limit(1)
                      ->first();

        //show the most popular three post based on their upvotes//
       //left join posts table and upvote_downvote table//
        $popularPosts= Post::query()
        ->leftJoin('upvote_downvotes', 'posts.id', '=', 'upvote_downvotes.post_id')
        ->select('posts.*', DB::raw('COUNT(upvote_downvotes.id) as upvote_count'))
        ->where(function ($query) {
            $query->whereNull('upvote_downvotes.is_upvote')
                 ->orWhere('upvote_downvotes.is_upvote', '=', 1);
        })
        ->where('active', '=', 1)
        ->whereDate('published_at', '<', Carbon::now())
        ->orderByDesc('upvote_count')
        ->groupBy([
            'posts.id',
            'posts.title',
            'posts.slug',
            'posts.thumbnails',
            'posts.body',
            'posts.active',
            'posts.published_at',
            'posts.user_id',
            'posts.created_at',
            'posts.updated_at',
            'posts.meta_title',
            'posts.meta_description',
        ])
        ->limit(5)
        ->get();

    return view('home',compact('latestPost','popularPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post , Request $request)
    {
        if(!$post->active || $post->published_at > Carbon::now()){
            throw new NotFoundHttpException();
        }
     
        $next=Post::query()
        ->where('active', true)
        ->whereDate('published_at', '<', Carbon::now())
        ->whereDate('published_at','<',$post->published_at)
        ->orderBy('published_at','desc')
        ->first();

        $prev=Post::query()
        ->where('active', true)
        ->whereDate('published_at', '<', Carbon::now())
        ->whereDate('published_at','>',$post->published_at)
        ->orderBy('published_at','asc')
        ->first();

        $user=request()->user();
        \App\Models\PostView::create([
          'ip_address'=>$request->ip(),
          'user_agent'=>$request->userAgent(),
          'post_id'=>$post->id,
          'user_id'=>$user?->id,
        ]); 
      return view('post.view',compact('post','next','prev'));
    }

  
    public function byCategory(Category $category)
    {
         $posts = Post::query()
            ->join('category_post', 'posts.id', '=', 'category_post.post_id')
            ->where('category_post.category_id', '=', $category->id)
            ->where('active', '=', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('home', compact('posts','category'));
    }
 }