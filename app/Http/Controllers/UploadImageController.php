<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UploadImageController extends Controller
{
    public function index()
    {
        return view('upload.index');
    }

    public function result()
    {
        return view('upload.result');
    }
}
