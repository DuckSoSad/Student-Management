@extends('layout.main')
@section('content')

    <!-- Nút thêm khóa sinh viên mới -->
    <div class="flex justify-center my-8">
        <a href="{{ route('course/add') }}">
            <button type="button"
                class="px-6 py-3 bg-cyan-600 text-white text-lg font-semibold rounded-2xl shadow-xl hover:bg-cyan-700 active:scale-95 transition-transform">
                + Thêm khóa sinh viên mới +
            </button>
        </a>
    </div>

    <!-- Hiển thị thông báo -->
    @if (isset($_SESSION['success']) && isset($_GET['msg']))
        <div id="flash-msg"
            class="mb-6 mx-auto max-w-xl p-4 rounded-2xl bg-green-100 text-green-800 text-center text-lg font-semibold shadow-md transition-all duration-500">
        </div>
        <script>
            setTimeout(() => {
                const flash = document.getElementById('flash-msg');
                if (flash) {
                    flash.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    flash.style.opacity = '0';
                    flash.style.transform = 'translateY(100px) rotate(3deg)';
                    flash.addEventListener('transitionend', () => {
                        flash.remove();
                    });
                }
            }, 1000);
        </script>
    @endif

    <!-- Hiển thị bảng -->
    @if (count($courses) > 0)
        <div class="overflow-x-auto mx-auto max-w-7xl mb-10">
            <table class="min-w-full bg-white shadow-lg text-center">
                <thead>
                    <tr class="bg-gradient-to-r from-rose-500 to-pink-500 text-white text-lg uppercase tracking-widest">
                        <th class="px-6 py-4 border border-gray-300">#</th>
                        <th class="px-6 py-4 border border-gray-300">Tên khóa học</th>
                        <th class="px-6 py-4 border border-gray-300">Ngày bắt đầu</th>
                        <th class="px-6 py-4 border border-gray-300">Ngày kết thúc</th>
                        <th class="px-6 py-4 border border-gray-300">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr class="hover:bg-rose-50 transition-all ease-in-out duration-200 text-base font-medium">
                            <td class="px-6 py-4 border border-gray-300">{{ $course->id }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $course->name }}</td>
                            <td class="px-6 py-4 border border-gray-300">
                                {{ \Carbon\Carbon::parse($course->start_date)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                {{ \Carbon\Carbon::parse($course->end_date)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 border border-gray-300 space-x-3">
                                <a href="{{ route('course/edit/' . $course->id) }}"
                                    class="inline-block px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 hover:scale-105 shadow-md transition-transform">Sửa</a>
                                <a href="{{ route('course/delete/' . $course->id) }}"
                                    class="inline-block px-4 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 hover:scale-105 shadow-md transition-transform"
                                    onclick="return confirm('Xóa thiệt hongg?!')">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center text-lg text-gray-700 italic mt-10">Không có khóa học nào!</p>
    @endif

@endsection