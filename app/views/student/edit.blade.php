@extends('layout.main')
@section('content')
<?php $old = $_SESSION['post_data'] ?? []; ?>

<div class="max-w-5xl mx-auto mt-5 mb-5 bg-white p-8 rounded-xl shadow-lg border border-rose-100">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-rose-700">Sửa Thông Tin Sinh Viên</h2>
        <a href="{{ route('admin/student') }}" class="inline-block">
            <button type="button"
                class="px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75 transition">
                Danh sách
            </button>
        </a>
    </div>

    <form action="{{ route('admin/student/update/' . $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Cột trái -->
            <div class="space-y-4">
                <!-- Ảnh sinh viên -->
                <div>
                    <label class="block text-sm font-medium text-gray-900">Ảnh sinh viên</label>
                    <div class="mt-2 flex items-center gap-4">
                        <!-- Ô chọn ảnh -->
                        <label
                            class="flex flex-col items-center justify-center w-72 h-32 bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-gray-500 transition">
                            <input type="file" name="avatar" id="avatar" class="hidden" onchange="previewImage(event)">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16v-4m0 0V8m0 4h4m-4 0H8m8 4a8 8 0 11-16 0 8 8 0 0116 0z">
                                </path>
                            </svg>
                            <span class="mt-1 text-xs text-gray-500">Chọn ảnh</span>
                        </label>

                        <!-- Preview ảnh -->
                        <div id="imagePreview" class="w-32 h-32 border rounded-lg overflow-hidden shadow-md 
                            {{ $student->avatar ? '' : 'hidden' }}">
                            <img id="preview" class="w-full h-full object-cover" src="{{ $student->avatar ? BASE_IMAGE . $student->avatar : '' }}" alt="Ảnh sinh viên">
                        </div>
                    </div>
                </div>

                <!-- Giới tính -->
                <div>
                    <label class="block text-sm font-medium text-gray-900">Giới tính</label>
                    <div class="mt-2 flex gap-4">
                        <label class="flex items-center gap-2 text-gray-700">
                            <input type="radio" name="gender" value="1"
                                class="text-rose-500 focus:ring-rose-500"
                                {{ $student->gender === 1 ? 'checked' : '' }}>
                            Nam
                        </label>
                        <label class="flex items-center gap-2 text-gray-700">
                            <input type="radio" name="gender" value="0"
                                class="text-rose-500 focus:ring-rose-500"
                                {{ $student->gender === 0 ? 'checked' : '' }}>
                            Nữ
                        </label>
                    </div>
                </div>

                <!-- Ngày sinh -->
                <div>
                    <label for="dob" class="block text-sm font-medium text-gray-900">Ngày sinh</label>
                    <input type="date" name="dob" id="dob" value="{{ $student->dob ?? $old['dob'] ?? '' }}"
                        class="mt-2 w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 focus:ring-rose-500 focus:border-rose-500 transition">
                </div>
            </div>

            <!-- Cột phải -->
            <div class="space-y-4">
                <!-- Tên sinh viên -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-900">Tên sinh viên</label>
                    <input type="text" name="name" id="name" value="{{ $student->name ?? $old['name'] ?? '' }}"
                        class="mt-2 w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 focus:ring-rose-500 focus:border-rose-500 transition">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email" value="{{ $student->email ?? $old['email'] ?? '' }}"
                        class="mt-2 w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 focus:ring-rose-500 focus:border-rose-500 transition">
                </div>

                <!-- Số điện thoại -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-900">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" value="{{ $student->phone ?? $old['phone'] ?? '' }}"
                        class="mt-2 w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 focus:ring-rose-500 focus:border-rose-500 transition">
                </div>

                <!-- Địa chỉ -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-900">Địa chỉ</label>
                    <input type="text" name="address" id="address" value="{{ $student->address ?? $old['address'] ?? '' }}"
                        class="mt-2 w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 focus:ring-rose-500 focus:border-rose-500 transition">
                </div>

                <!-- Ngành học -->
                <div>
                    <label for="major_id" class="block text-sm font-medium text-gray-900">Ngành học</label>
                    <select name="major_id" id="major_id"
                        class="mt-2 w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 focus:ring-rose-500 focus:border-rose-500 transition">
                        <option value="">Chọn ngành</option>
                        @foreach ($majors as $major)
                        <option value="{{ $major->id }}"
                            {{ (isset($student) && $student->major_id == $major->id) || (isset($old['major_id']) && $old['major_id'] == $major->id) ? 'selected' : '' }}>
                            {{ $major->name }}
                        </option>
                        @endforeach
                    </select>
                </div>


                <!-- Khóa học -->
                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-900">Khóa học</label>
                    <select name="course_id" id="course_id"
                        class="mt-2 w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 focus:ring-rose-500 focus:border-rose-500 transition">
                        <option value="">Chọn khóa</option>
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}"
                            {{ (isset($student) && $student->course_id == $course->id) || (isset($old['course_id']) && $old['course_id'] == $course->id) ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Nút submit -->
        <button type="submit" name="edit" value="edit"
            class="mt-6 w-full flex justify-center rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-rose-700 transition"
            onclick="return confirm('Xác nhận thay đổi thông tin?')">
            Lưu thông tin sinh viên
        </button>
    </form>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById("preview");
            const imagePreview = document.getElementById("imagePreview");

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    imagePreview.classList.remove("hidden");
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

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
        }, 3000);
    </script>

    @endif
</div>

<?php unset($_SESSION['post_data']); ?>
<?php unset($_SESSION['errors']); ?>
@endsection