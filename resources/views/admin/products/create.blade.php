@extends('admin.master')
@section('title','All Products |' .env('APP_NAME'))
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create New Product</h1>
    <a class="btn btn-dark" href="{{route('admin.product.index')}}">All Products</a>
</div>

@include('admin.parts.errors')

<form action="{{route('admin.product.store')}}"method="post" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" placeholder="Name"/>
    </div>

    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control"/>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea class="form-control" placeholder="Description" name="description" rows="5"></textarea>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control" placeholder="Price" />
    </div>

    <div class="mb-3">
        <label>Sale Price</label>
        <input type="number" name="Sale_Price" class="form-control" placeholder=" Sale Price" />
    </div>

    <div class="mb-3">
        <label>Quantity</label>
        <input type="number" name="quantity" class="form-control" placeholder="Quantity" />
    </div>

    <div class="mb-3">
        <label>Category</label>
        <select name="category_id" class="form-control" >
              <option value="" disabled selected></option>

        @foreach ($categories as $item)
        <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach

        </select>


    </div>
    <button class="btn btn-success px-5">Save</button>
</form>

@stop

