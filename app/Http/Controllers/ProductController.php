<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\HttpResponses;
use App\Http\Controllers\MediaController;
use Faker\Core\Number;

use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(ProductResource::collection(Product::orderBy('order', 'asc')->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $request->validated();

        if ($request->has(MediaController::DEFAULT_MEDIA_KEY)) {
            $media = MediaController::createImage($request->file(MediaController::DEFAULT_MEDIA_KEY));
            $request->merge(['media_id' => $media->id]);
        }

        $product = Product::create([
            "name" => $request->name,
            "slug" => $request->slug,
            "price" => $request->price,
            "description" => $request->description,
            "order" => $request->order,
            "category_id" => $request->category_id,
            "user_id" => Auth::user()->id,
            "media_id" => $request->media_id
        ]);

        return $this->success(new ProductResource($product));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->success(new ProductResource($product));
    }

    /**
     * Display the specified resource by slug.
     */
    public function showById(String $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        return $this->success(new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        unset($request["_method"]);

        if ($request->has(MediaController::DEFAULT_MEDIA_KEY)) {
            $media = MediaController::createImage($request->file(MediaController::DEFAULT_MEDIA_KEY));
            if (is_int($product->media_id)) {
                MediaController::dropImageFromStorage($product->media_id);
            }
            $request->merge(['media_id' => $media->id]);
        } else if ($request->has('media_id') && isNull($request->all()["media_id"])) {
            if (is_int($product->media_id)) {
                try {
                    MediaController::dropImageFromStorage($product->media_id);
                } catch (\Throwable $th) {
                    return throw $th;
                }
            }
        }

        $product->update($request->all());

        return $this->success(new ProductResource($product));
    }

    /**
     * Bulk Update the specified resource in storage.
     *
     *
     * with this function, user can update multiple products price at once
     *
     */
    public function bulkPriceUpdate(Request $request)
    {
        $products = $request->all();
        foreach ($products as $product) {
            Product::where('id', $product['id'])->update(['price' => $product['price']]);
        }
        return $this->success(ProductResource::collection(Product::orderBy('order', 'asc')->get()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (is_int($product->media_id)) {
            MediaController::dropImageFromStorage($product->media_id);
        }
        return $this->success($product->delete(), "Product deleted successfully", 204);
    }
}
