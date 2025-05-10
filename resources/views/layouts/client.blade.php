<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang bài viết</title>
    @vite('resources/css/app.css') {{-- Nếu dùng Vite --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
    @yield('content')
</body>

</html>
