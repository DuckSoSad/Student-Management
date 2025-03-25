@extends('layout.main')
@section('content')

    <!-- Nút thêm khóa sinh viên mới -->
    <div class="flex justify-center my-8">
        <a href="{{ route('student/add') }}">
            <button type="button"
                class="px-6 py-3 bg-cyan-600 text-white text-lg font-semibold rounded-2xl shadow-xl hover:bg-cyan-700 active:scale-95 transition-transform">
                + Thêm sinh viên mới +
            </button>
        </a>
    </div>

    <!-- Hiển thị thông báo -->
    @if (isset($_SESSION['success']) && isset($_GET['msg']))
        <div id="flash-msg"
            class="mb-6 mx-auto max-w-xl p-4 rounded-2xl bg-green-100 text-green-800 text-center text-lg font-semibold shadow-md transition-all duration-500">
            <span>{{ $_SESSION['success'] }}</span>
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
    @if (count($students) > 0)
        <div class="overflow-x-auto mx-auto max-w-8xl mb-10">
            <table class="min-w-full bg-white shadow-lg text-center">
                <thead>
                    <tr class="bg-gradient-to-r from-rose-500 to-pink-500 text-white text-lg uppercase tracking-widest">
                        <th class="px-6 py-4 border border-gray-300">#</th>
                        <th class="px-6 py-4 border border-gray-300">Ảnh</th>
                        <th class="px-6 py-4 border border-gray-300">Tên</th>
                        <th class="px-6 py-4 border border-gray-300">Email</th>
                        <th class="px-6 py-4 border border-gray-300">Số điện thoại</th>
                        <th class="px-6 py-4 border border-gray-300">Giới tính</th>
                        <th class="px-6 py-4 border border-gray-300">Ngành học</th>
                        <th class="px-6 py-4 border border-gray-300">Khóa</th>
                        <th class="px-6 py-4 border border-gray-300">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr class="hover:bg-rose-50 transition-all ease-in-out duration-200 text-base font-medium">
                            <td class="px-6 py-4 border border-gray-300">{{ $student->id }}</td>
                            <td class="px-6 py-4 border border-gray-300">
                                <img src="{{ BASE_IMAGE . $student->avatar }}" alt="{{ $student->name }}"
                                    class="w-12 h-12 rounded-full">
                            </td>
                            <td class="px-6 py-4 border border-gray-300">{{ $student->name }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $student->email }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $student->phone }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $student->gender ? "Nam" : "Nữ" }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $student->major_name }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $student->course_name }}</td>
                            <td class="px-6 py-4 border border-gray-300 space-x-3">
                                <a href="{{ route('student/edit/' . $student->id) }}"
                                    class="inline-block px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 hover:scale-105 shadow-md transition-transform">Sửa</a>
                                <a href="{{ route('student/delete/' . $student->id) }}"
                                    class="inline-block px-4 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 hover:scale-105 shadow-md transition-transform"
                                    onclick="return confirm('Xóa thiệt hongg?!')">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center text-lg text-gray-700 italic mt-10">Không có sinh viên nào!</p>
    @endif

    <?php unset($_SESSION['success']); ?>
@endsection