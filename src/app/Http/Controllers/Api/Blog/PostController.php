<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Resources\BlogPostResource;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostCreateUpdateRequest;
use Mockery\Exception;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        DB::enableQueryLog();
        $posts = BlogPost::paginate(10);
        return BlogPostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateUpdateRequest $request)
    {
        try {
            $post = new BlogPost();
            $post->user_id = $request->input('user_id');
            $post->slug = $request->input('slug');
            $post->title = $request->input('title');
            $post->content = $request->input('content');

            $post->save();

            return response()->json(['message' => 'Post created successfully'], 201);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostCreateUpdateRequest $request, string $id)
    {
        try {
            $post = BlogPost::find($id);

            if ($post == null) {
                return response()->json(['message' => 'Post not found'], 404);
            }

            $post->user_id = $request->input('user_id');
            $post->slug = $request->input('slug');
            $post->title = $request->input('title');
            $post->content = $request->input('content');

            $post->save();

            return response()->json(['message' => 'Post updated successfully'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            BlogPost::where('id', $id)->delete();
            return response()->json(['message' => 'Post delete successfully'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
