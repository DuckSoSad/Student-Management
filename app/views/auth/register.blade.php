@extends('layout.auth')

@section('content')
    <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-xl space-y-6">
        <h1 class="text-3xl font-bold text-center text-gray-800">TOOL QUẢN LÝ SINH VIÊN</h1>

        <h2 class="text-xl font-semibold text-center text-gray-700">Tạo tài khoản mới</h2>

        <form class="space-y-4" method="POST" action="{{ BASE_URL }}res">
            @csrf

            <!-- Username -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700">Tên đăng nhập</label>
                <input type="text" name="username" required
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Email -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Password -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Confirm Password -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700">Xác nhận mật khẩu</label>
                <input type="password" name="confirm_password" id="confirm_password" required
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <p id="password-error" class="text-red-500 text-sm mt-1 hidden">Mật khẩu không khớp!</p>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="register-btn"
                class="w-full px-4 py-2 text-white bg-blue-500 rounded-md shadow-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                Đăng ký
            </button>
        </form>

        <!-- Hiển thị lỗi nếu có -->
        @if (isset($_SESSION['error']) && isset($_GET['msg']))
            <div id="error-flash" class="mb-4 p-4 mt-3 rounded bg-red-100 text-red-700 shadow-md">
                <span>{{ $_SESSION['error'] }}</span>
            </div>

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

        <p class="text-sm text-center text-gray-600">
            Đã có tài khoản? <a href="{{ BASE_URL }}login" class="text-blue-500 hover:underline">Đăng nhập</a>
        </p>
    </div>

    <script>
        document.getElementById('register-btn').addEventListener('click', function (event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const errorText = document.getElementById('password-error');

            if (password !== confirmPassword) {
                event.preventDefault();
                errorText.classList.remove('hidden');
            } else {
                errorText.classList.add('hidden');
            }
        });
    </script>

@endsection