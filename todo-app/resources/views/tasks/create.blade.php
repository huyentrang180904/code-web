@extends('layouts.app')
@section('content')
<div class ="container">
    <h1 class ="text-2xl font-bold mb-4">Thêm công việc mới</h1>
    @if($errors->any())
        <div class ="bg-red-100 text-red-700 p-2 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{$error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action = "{{route('tasks.store')}}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Nhập tên công việc" class="w-full border p-2 rounded mb-4" required>
        <button type="submit" class ="bg-green-500 text-white px-4 py-2 rounded">Lưu</button>
        <a href="{{ route('tasks.index')}}" class="ml-2 text-gray-600">Quay lại</a>
    </form>
</div>
@endsection