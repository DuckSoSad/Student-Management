<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="min-h-screen flex flex-col bg-rose-50 text-gray-800">

    <!-- Header -->
    <header class=" shadow-sm border-b border-rose-200">
        <div class="container mx-auto px-6 py-5 flex items-center justify-between">
            <h1 class="text-3xl font-semibold text-rose-600">{{ $title }}</h1>
            <nav class="space-x-6 text-[15px] font-medium">
                <a href="{{ route('') }}" class="text-gray-700 hover:text-rose-500 transition">Trang chủ</a>
                <a href="{{ route('course') }}" class="text-gray-700 hover:text-rose-500 transition">Khóa sinh viên</a>
                <a href="{{ route('major') }}" class="text-gray-700 hover:text-rose-500 transition">Ngành học</a>
                <a href="{{ route('student') }}" class="text-gray-700 hover:text-rose-500 transition">Sinh viên</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow shadow-sm">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class=" border-t border-rose-200">
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