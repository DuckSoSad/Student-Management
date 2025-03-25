@extends('layout.main')
@section('content')
    <?php $old = $_SESSION['post_data'] ?? []; ?>

    <div class="max-w-2xl mx-auto mt-5 mb-5 bg-white p-8 rounded-xl shadow-lg border border-rose-100">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-rose-700">Sửa Khóa Sinh Viên</h2>
            <a href="{{ route('course') }}" class="inline-block">
                <button type="button"
                    class="px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75 transition">
                    Danh sách
                </button>
            </a>
        </div>

        <form action="{{ route('course/update/' . $course->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Tên khóa sinh viên -->
            <div>
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Tên khóa sinh viên</label>
                <div class="mt-2">
                    <input type="text" name="name" id="name" value="{{ $course->name ?? $old['name'] ?? '' }}"
                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rose-500 sm:text-sm sm:leading-6">
                </div>
            </div>

            <!-- Ngày bắt đầu -->
            <div>
                <label for="start_date" class="block text-sm font-medium leading-6 text-gray-900">Ngày bắt đầu</label>
                <div class="mt-2">
                    <input type="date" name="start_date" id="start_date"
                        value="{{ $course->start_date ?? $old['start_date'] ?? '' }}"
                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-rose-500 sm:text-sm sm:leading-6">
                </div>
            </div>

            <!-- Ngày kết thúc -->
            <div>
                <label for="end_date" class="block text-sm font-medium leading-6 text-gray-900">Ngày kết thúc</label>
                <div class="mt-2">
                    <input type="date" name="end_date" id="end_date"
                        value="{{ $course->end_date ?? $old['end_date'] ?? '' }}"
                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-rose-500 sm:text-sm sm:leading-6">
                </div>
            </div>

            <!-- Nút submit -->
            <button type="submit"
                class="flex w-full justify-center rounded-md bg-rose-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-rose-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-500 transition"
                name="edit" value="edit" onclick="return confirm('Xác nhận thay đổi thông tin?')">

                Lưu khóa sinh viên
            </button>
        </form>

        @if (isset($_SESSION['errors']) && isset($_GET['msg']))
            <div id="error-flash" class="mb-4 p-4 mt-3 rounded bg-red-100 text-red-700 shadow-md">
                <ul>
                    @foreach ($_SESSION['errors'] as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>

            <style>
                #error-flash {
                    transition: all 1s ease, opacity 1s ease;
                    transform-origin: center;
                }

                .fade-shrink {
                    opacity: 0;
                    padding-top: 0;
                    padding-bottom: 0;
                    margin-top: 0;
                    margin-bottom: 0;
                    transform: scaleX(0);
                    height: 0;
                    overflow: hidden;
                }
            </style>

            <script>
                setTimeout(() => {
                    const flash = document.getElementById('error-flash');
                    if (flash) {
                        flash.classList.add('fade-shrink');
                        setTimeout(() => flash.remove(), 1000);
                    }
                }, 2000); 
            </script>

        @endif
    </div>

    <?php unset($_SESSION['post_data']); ?>
    <?php unset($_SESSION['errors']); ?>
@endsection