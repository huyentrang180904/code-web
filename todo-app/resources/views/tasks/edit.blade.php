@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Sửa công việc</h1>
    @if($errors->any())
        <div class ="bg-red-100 text-red-700 p-2 rounded mb-4">
            <ul>
                @foreach($errors->all() as $errror)
                    <li>- {{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('tasks.update', $task)}}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{$task->title}}" class="w-full border p-2 rounded mb-4" required>
        <button type ="submit" class="bg-yellow-500 text-while px-4 py-2 rounded">Cập nhật</button>
        <a href="{{route('tasks.index')}}" class="ml-2 text-gray-600">Quay lại</a>
    </form>
</div>
@endsection