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
 
        $file = Files::create($data);
 
        return new FilesResource($file);
    }
}
