@extends('layout.auth')

@section('content')
    <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-xl space-y-6">
        <h1 class="text-3xl font-bold text-center text-gray-800">TOOL QUẢN LÝ SINH VIÊN</h1>

        <h2 class="text-xl font-semibold text-center text-gray-700">Đăng nhập vào hệ thống</h2>

        <form class="space-y-4" method="POST" action="{{ BASE_URL }}login">
            @csrf

            <div class="relative">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 12H8m8 0H8m0 0V8m0 4v4m8-4v4m0 0v4m-4-4h4m-4 0H8"></path>
                        </svg>
                    </span>
                    <input type="email" name="email" required
                        class="w-full px-4 py-2 pl-10 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <div class="relative">
                <label class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 15v2m0-2a2 2 0 012-2h4a2 2 0 012 2v2m-6 0h6m-6 0a2 2 0 00-2 2m2-2V9a3 3 0 013-3m0 0a3 3 0 013 3v6">
                            </path>
                        </svg>
                    </span>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2 pl-10 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <button type="submit"
                class="w-full px-4 py-2 text-white bg-blue-500 rounded-md shadow-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                Đăng nhập
            </button>
        </form>

        @if (isset($_SESSION['error']) && isset($_GET['msg']))
            <div id="error-flash" class="mb-4 p-4 mt-3 rounded bg-red-100 text-red-700 shadow-md">
                <span>{{ $_SESSION['error'] }}</span>
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

        <p class="text-sm text-center text-gray-600">
            Chưa có tài khoản? <a href="{{ BASE_URL }}register" class="text-blue-500 hover:underline">Đăng ký</a>
        </p>
    </div>
@endsection