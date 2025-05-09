<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không tìm thấy trang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-md-6 text-center">
                <h1 class="display-1">404</h1>
                <h2 class="mb-4">Không tìm thấy trang</h2>
                <p class="lead mb-4">Trang bạn đang tìm kiếm không tồn tại hoặc đã bị di chuyển.</p>
                <a href="{{ url('/') }}" class="btn btn-primary">Quay về trang chủ</a>
            </div>
        </div>
    </div>
</body>
</html> 