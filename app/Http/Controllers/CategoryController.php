<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;

use function PHPUnit\Framework\isNull;

class CategoryController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(CategoryResource::collection(
            Category::orderBy('order', 'asc')->get()
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $request->validated();

        if ($request->has(MediaController::DEFAULT_MEDIA_KEY)) {
            $media = MediaController::createImage($request->file(MediaController::DEFAULT_MEDIA_KEY));
            $request->merge(['media_id' => $media->id]);
        }

        $category = Category::create([
            "name" => $request->name,
            "slug" => $request->slug,
            "description" => $request->description,
            "order" => $request->order,
            "user_id" => Auth::user()->id,
            "media_id" => $request->media_id
        ]);

        return $this->success(new CategoryResource($category));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->success(new CategoryResource($category));
    }

    /**
     * Display the specified resource by slug.
     */
    public function showBySlug(String $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return $this->success(new CategoryResource($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        unset($request["_method"]);
        if ($request->has(MediaController::DEFAULT_MEDIA_KEY)) {
            $media = MediaController::createImage($request->file(MediaController::DEFAULT_MEDIA_KEY));
            if (is_int($category->media_id)) {
                MediaController::dropImageFromStorage($category->media_id);
            }
            $request->merge(['media_id' => $media->id]);
        } else if ($request->has('media_id') && isNull($request->all()["media_id"])) {
            if (is_int($category->media_id)) {
                try {
                    MediaController::dropImageFromStorage($category->media_id);
                } catch (\Throwable $th) {
                    return throw $th;
                }
            }
        }

        $category->update($request->all());
        return $this->success(new CategoryResource($category));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($this->isNotAuthorized($category)) {
            return $this->isNotAuthorized($category);
        } else {
            if (is_int($category->media_id)) {
                MediaController::dropImageFromStorage($category->media_id);
            }
            return $this->success($category->delete(), 204);
        }
    }

    private function isNotAuthorized($category)
    {
        if (Auth::user()->id !== $category->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }
    }
}
