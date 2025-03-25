<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="min-h-screen flex flex-col bg-rose-50 text-gray-800">

    <!-- Toast Notification -->
    @if(isset($_SESSION['auth_welcome']))
        <div x-data="{ show: true }" x-show="show"
            x-transition:enter="transition ease-out duration-500 transform opacity-0 translate-y-[-20px]"
            x-transition:enter-start="opacity-0 translate-y-[-20px]" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-500 transform opacity-0 translate-y-[-20px]"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-[-20px]"
            x-init="setTimeout(() => show = false, 2000)" class="fixed top-10 left-1/2 transform -translate-x-1/2 z-50">
            <div class="bg-green-500 text-white text-xl px-6 py-4 rounded-lg shadow-lg">
                🎉 Xin chào, <strong>{{ $_SESSION['auth']['name'] }}</strong>!
            </div>
        </div>
    @endif


    <!-- Header -->
    <header class="shadow-sm border-b border-rose-200">
        <div class="container mx-auto px-6 py-5 flex items-center justify-between">
            <h1 class="text-3xl font-semibold text-rose-600">{{ $title }}</h1>
            <nav class="space-x-6 text-[15px] font-medium flex items-center">
                <a href="{{ route('admin') }}" class="text-gray-700 hover:text-rose-500 transition">Trang chủ</a>
                <a href="{{ route('admin/course') }}" class="text-gray-700 hover:text-rose-500 transition">Khóa học</a>
                <a href="{{ route('admin/major') }}" class="text-gray-700 hover:text-rose-500 transition">Ngành học</a>
                <a href="{{ route('admin/student') }}" class="text-gray-700 hover:text-rose-500 transition">Sinh
                    viên</a>

                <!-- Nút đăng xuất -->
                <form action="{{ route('logout') }}" method="POST" class="inline-block">
                    <button type="submit"
                        class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600 transition">
                        Đăng xuất
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <?php unset($_SESSION['auth_welcome']); ?>

    <!-- Main Content -->
    <main class="flex-grow shadow-sm">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-rose-200">
        <div
            class="container mx-auto px-6 py-5 flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
            <p class="text-sm text-gray-500">&copy; 2025 Student Management. All rights reserved.</p>
            <div class="space-x-5 text-sm">
                <a href="#" class="text-gray-500 hover:text-rose-500 transition">Privacy Policy</a>
                <a href="#" class="text-gray-500 hover:text-rose-500 transition">Contact</a>
            </div>
        </div>
    </footer>

</body>

</html>