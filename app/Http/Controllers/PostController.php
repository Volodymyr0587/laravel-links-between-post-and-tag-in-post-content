<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $validated['image'] = $this->handleImageUpload($request);

        $post = auth()->user()->posts()->create($validated);

        $tags = explode(',', trim($request->tags));

        $existingTags = Tag::whereIn('name', $tags)->pluck('name')->toArray();
        $uniqueTags = array_diff($tags, $existingTags);

        if (!empty($existingTags)) {
            return back()->with('warning', 'Tags ' . implode(', ', $existingTags) . ' already exists in other posts');
        }

        foreach ($uniqueTags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag->id);
        }

        $this->linkTags($post);

        return to_route('posts.index')->with('success', "Post $post->title successfully created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('editPost', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        Gate::authorize('editPost', $post);

        $validated = $request->validated();

        // Обробка зображення
        if ($request->hasFile('image')) {
            $validated['image'] = $this->handleImageUpload($request);
        }

        $post->update($validated);

        $post->tags()->detach();
        $tags = explode(',', $request->tags);

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag->id);
        }

        // Оновлення посилань на основі нових тегів
        $this->linkTags($post);

        return to_route('posts.index')->with('success', "Post $post->title successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('editPost', $post);

        // Видалення всіх зв'язків тегів з цією новиною
        $post->tags()->detach();

        // Видалення посилань на цю новину в інших новинах
        $this->removeLinks($post);

        $post->delete();

        return to_route('posts.index')->with('success', "Post $post->title successfully updated");
    }

    protected function handleImageUpload($request)
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('posts', 'public');
        }

        return null;
    }

    private function linkTags(Post $post)
    {
        $allPosts = Post::all();

        foreach ($allPosts as $otherPost) {
            if ($otherPost->id !== $post->id) {
                foreach ($post->tags as $tag) {
                    if (str_contains($otherPost->content, $tag->name)) {
                        $otherPost->content = str_replace($tag->name, "<a href='/posts/{$post->slug}' class='text-blue-500'>{$tag->name}</a>", $otherPost->content);
                        $otherPost->save();
                    }
                }
            }
        }
    }

    private function removeLinks(Post $deletedPost)
    {
        $allPost = Post::all();
        foreach ($allPost as $otherPost) {
            if ($otherPost->id !== $deletedPost->id) {
                foreach ($deletedPost->tags as $tag) {
                    $link = "<a href='/post/{$deletedPost->id}'>{$tag->name}</a>";
                    $otherPost->content = str_replace($link, $tag->name, $otherPost->content);
                }
                $otherPost->save();
            }
        }

        // Додаткова перевірка для видалення тегів, які більше не використовуються
        $tagsToRemove = Tag::doesntHave('posts')->get();
        foreach ($tagsToRemove as $tag) {
            $tag->delete();
        }
    }
}
