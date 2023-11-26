<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Resources\MediaResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Traits\HttpResponses;

class MediaController extends Controller
{
    use HttpResponses;

    public const DEFAULT_MEDIA_KEY = "media";
    public const DEFAULT_MEDIA_PATH = "uploads/media";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($media)
    {
        $media = Media::create($media);

        return $media;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        self::validateImage($request);

        $media = self::createImage($request->file(self::DEFAULT_MEDIA_KEY));

        return isset($media->id) ? $this->success(new MediaResource($media), "Media created successfully") : $this->error($media);
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        return $this->success(new MediaResource($media));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //Codes..
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //Codes..
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        try {
            /**
             * @description this code will delete the file from the server
             */
            unlink($media->url);
            return $this->success($media->delete(), "Media deleted successfully", 204);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th, "Media deletion failed", 500);
        }
    }


    /**
     * @description validate image
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public static function validateImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            self::DEFAULT_MEDIA_KEY => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "Validation error", "errors" => $validator->errors()], 400);
        }

        return true;
    }


    /**
     * @description create image and save to database
     * @param UploadedFile $file
     * @param string $targetPath
     *
     * @return Media|\Throwable
     *
     * @throws \Throwable
     */
    public static function createImage(UploadedFile $file, $targetPath = "")
    {
        try {
            $media = [];
            $media["name"] = $file->getClientOriginalName();
            $media["path"] = self::DEFAULT_MEDIA_PATH . $targetPath;
            $media["type"] = $file->getMimeType();
            $media["size"] = $file->getSize();
            $media["extension"] = $file->getClientOriginalExtension();
            $media["mime_type"] = $file->getMimeType();
            $media["filename"] = Str::random(16) . "." . $file->getClientOriginalExtension();
            $media["url"] = $media["path"] . "/" . $media["filename"];
            $media["disk"] = "public";
            $media["directory"] = "media";

            $path = public_path($media["path"]);
            $file->move($path, $media["filename"]);

            return Media::create($media);
        } catch (\Throwable $th) {
            return $th;
        }
    }



    public static function dropImageFromStorage(int $id)
    {
        try {
            $medias = Media::all()->where("id", $id);
            $media = $medias->first();
            unlink($media->url);
            $media->delete();
            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
