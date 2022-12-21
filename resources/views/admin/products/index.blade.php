 @extends('admin.master')
@section('title','All Products |' .env('APP_NAME'))

@section('styles')
    <style>
        .table th, .table td{
            vertical-align: middle;
        }
    </style>
@stop

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">All Products</h1>
    <a class="btn btn-dark" href="{{route('admin.product.create')}}">All New Products</a>
</div>

@if (session('msg'))

    <div class="alert alert-{{session('type')}}">{{session('msg')}}</div>

@endif

<table class="table table-hover table-borders table-striped">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Sale Price</th>
        <th>Quantity</th>
        <th>Category</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    @forelse ($products as $product)
    <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td><img width="100" src="{{asset('uploads/images/products/'.$product->image)}}" alt=""></td>
        <td>{{$product->price}}</td>
        <td>{{$product->sale_price}}</td>
        <td>{{$product->quantity}}</td>
        <td>{{$product->category_id}}</td>
        <td>{{$product->created_at->diffForHumans()}}</td>
        <td>
            <a class="btn btn-sm btn-primary" href="{{route('admin.product.edit' , $product->id)}}">
            <i class="fas fa-edit"></i></a>

            <form class="d-inline" action="{{route('admin.product.destroy' , $product->id)}}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')"><i class="fas fa-trash"> </i></button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="9" class="text-center text-danger">No Data Yet</td>
    </tr>
    @endforelse
</table>
{{$products->links()}}

@stop







