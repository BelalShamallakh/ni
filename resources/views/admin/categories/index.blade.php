@extends('admin.master')
@section('title','All Categories |' .env('APP_NAME'))

@section('styles')
    <style>
        .table th, .table td{
            vertical-align: middle;
        }
    </style>
@stop

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">All Categories</h1>
    <a class="btn btn-dark" href="{{route('admin.categories.create')}}">All New Categories</a>
</div>

@if (session('msg'))

    <div class="alert alert-{{session('type')}}">{{session('msg')}}</div>

@endif

<table class="table table-hover table-borders table-striped">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Parent</th>
        <th>Actions</th>
    </tr>
    @foreach ($categories as $category)
    <tr>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td><img width="100" src="{{asset('uploads/images/'.$category->image)}}" alt=""></td>
        {{-- @if($category->parent_id == $category->id)
        <td>{{$category->name}}</td>
        @endif --}}
        <td>{{$category->parent->name}}</td>

        <td>
            <a class="btn btn-sm btn-primary" href="{{route('admin.categories.edit' , $category->id)}}">
            <i class="fas fa-edit"></i></a>

            <form class="d-inline" action="{{route('admin.categories.destroy' , $category->id)}}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')"><i class="fas fa-trash"> </i></button>
            </form>
        </td>
    </tr>

    @endforeach
</table>
{{$categories->links()}}

@stop

