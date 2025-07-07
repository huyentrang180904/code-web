@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class = "text-2xl font-bold mb-4">Danh sách công việc</h1>

    @if (session('success'))
        <div class = "bg-green-100 text-green-700 p-2 rounded mb-4">
            {{session('success')}}
        </div>
    @endif

    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">+ Thêm công việc</a>

    <ul class ="space-y-2">
        @forelse ($tasks as $task)
            <li class ="flex justify-between items-center bg-gray-100 p-3 rounded">
                <form action ="{{ route('task.toggle', $task) }}" method="POST">
                    @csrf
                    <button type="submit" class ="mr-4 {{ $task-> is_done ? 'line-through text-gray-500' : ''}}">
                        {{ $task->title }}
                    </button>
                </form>

                <div class ="flex gap-2">
                    <a href ="{{ route('tasks.edit', $task) }}" class ="text-blue-500">Sửa</a>
                    <form action ="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Bạn muốn xóa công việc này?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500">Xóa</button>
                    </form>
                </div>
            </li>
        @empty
            <p>Chưa có công việc nào.</p>
        @endforelse
    </ul>
        
</div>
    
@endsection