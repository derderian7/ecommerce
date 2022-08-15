@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="cardheader">
            <h4>edit category</h4> </div>
        <div class="card-body">
            <form action="{{ url('update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" value="{{$category->name}}" class="form-control" name="name">
                    </div>
                    <div class="col-med-6">
                        <label>Slug</label>
                        <input type="text" value="{{$category->slug}}" class="form-control" name="slug">
                    </div>
                    <div class="col-md-12">
                    <textarea name="description"  rows="3" class="form-control"> {{$category->description}}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <input type="checkbox" {{$category->status == '1' ? 'checked':'null'}} name="status">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Popular</label>
                    <input type="checkbox" {{$category->popular == '1' ? 'checked':'null'}} name="popular">
                </div>
                <div class="col-md-6 mb-3">
                    <label>meta_title</label>
                    <input type="text" value="{{$category->meta_title}}" class="form-control" name="meta_title">
                </div>
                <div class="col-md-12">
                    <label>meta_desc</label>
                    <textarea name="meta_desc"  rows="3" class="form-control"> {{$category->meta_desc}}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>meta_keywords</label>
                    <input type="text" value="{{$category->meta_keywords}}" class="form-control" name="meta_keywords" rows="3">
                </div>
                @if ($category->image)
                <img src="{{asset('assets/uploads/category/'.$category->image)}}" alt="category image">
                    
                @endif
                <div class="col-md-12">
                    <input type="file" name="image" class="form_control">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </div>
            </form>
            </div>        
    </div>
@endsection