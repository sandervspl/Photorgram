@extends('layouts.master')
@section('title', 'Upload')
@section('content')
<section class="main-article">
    <h1>Upload New Image</h1>

    <div id="upload-form-container">
        <form action="" method="post" enctype="multipart/form-data" id="upload-form">
            <label for="upload-title">Title</label>
                <input type="text" id="upload-title" name="upload-title">

            <label for="upload-category">Category</label>
            <select name="upload-category" id="upload-category">
                <option value="0" >Comics</option>
            </select>

            <label for="upload-file">Upload Image</label>
            <input type="file" name="upload-file" id="upload-file"> <br/>

            <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>
</section>
@endsection