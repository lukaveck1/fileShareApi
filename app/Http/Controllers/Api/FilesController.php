<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilesRequest;
use App\Http\Resources\FilesResource;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilesController extends Controller
{
    public function index()
    {
        return FilesResource::collection(Files::all()); 
    }

    public function show(Files $file) 
    {
        return new FilesResource($file);
    }

    public function store(StoreFilesRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('photo')) { 
            $file = $request->file('photo');
            $name = 'files/' . Str::uuid() . '.' . $file->extension();
            $file->storePubliclyAs('public', $name);
            $data['photo'] = $name;
        } 

        if (!$this->isFilePhoto($name)) {
            return response()->json(['error' => 'File MIME type must be image.']);
        }
 
        $file = Files::create($data);
 
        return new FilesResource($file);
    }

    /**
     * Check if file MIME type is image
     * @param string $name
     * @return bool
     */
    protected function isFilePhoto(string $name) {
        return strstr(mime_content_type(storage_path() . '/app/public/' . $name), "image/");
    }
}
