@extends('admin.master')
@section('title','Edit Product |' .env('APP_NAME'))
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
    <a class="btn btn-dark" href="{{route('admin.products.index')}}">All Products</a>
</div>

<form action="{{route('admin.products.update',$product->id)}}"method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{$product->name}}" placeholder="Name" />
    </div>

    <div class="mb-3">
        <label>Image</label>
        <input id="img-input" type="file" name="image" class="form-control"/>
        <img id='img-item' width="70" src="{{asset('uploads/images/'.$product->image)}}" alt="">
    </div>
    <div class="mb-3">
        <label>Parent</label>
        <select name="parent_id" class="form-control" >
              <option value="" disabled selected>--select--</option>

        @foreach ($products as $item)
        <option {{$product->parent_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
        </select>


    </div>
    <button class="btn btn-info px-5">Edit</button>
</form>
@stop
@section('scripts')
    <script>

        document.querySelector('#img-item').onclick=function(){
        document.querySelector('#img-input').click();
    }
    document.getElementById('img-input').onchange = function (evt) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;

    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            document.getElementById('img-item').src = fr.result;
        }
        fr.readAsDataURL(files[0]);
    }

    // Not supported
    else {
        // fallback -- perhaps submit the input to an iframe and temporarily store
        // them on the server until the user's session ends.
    }
}

    </script>
@stop

