# Kiến trúc dự án Laravel

## Cấu trúc thư mục

### app/Http
- Chứa các controllers xử lý HTTP requests
- Middleware để xử lý các request trước khi đến controller
- Form requests để validate dữ liệu đầu vào

### app/Providers
- Service providers để đăng ký các services, bindings
- Cấu hình các service container bindings
- Boot các services khi ứng dụng khởi động

### resources/views
- Chứa các file blade templates
- Layouts và components có thể tái sử dụng
- Assets như CSS, JavaScript, images

### routes/
- Định nghĩa các routes của ứng dụng
- API routes trong api.php
- Web routes trong web.php
- Console commands trong console.php

### storage/
- Chứa các file được tạo bởi ứng dụng
- Log files
- Cache files
- Uploaded files
- Compiled views

### bootstrap/
- Chứa các file khởi động ứng dụng
- app.php: Khởi tạo ứng dụng
- cache/: Cache files
- config.php: Load configuration

## Service Container

Service Container là một công cụ mạnh mẽ để quản lý dependencies và thực hiện dependency injection trong Laravel. Nó nằm trong `Illuminate\Container\Container` và được khởi tạo trong `bootstrap/app.php`.

### Vai trò:
- Quản lý các dependencies
- Tự động resolve các dependencies
- Cho phép binding interfaces với implementations
- Hỗ trợ singleton và shared instances

## Chuẩn đặt tên

### PSR-4 Autoloading
- Namespace phải map với cấu trúc thư mục
- Ví dụ: `App\Services\Translator` map với `app/Services/Translator.php`

### PSR-12 Coding Style
- Sử dụng 4 spaces cho indentation
- Mỗi file PHP phải kết thúc bằng một dòng trống
- Mỗi dòng không được vượt quá 120 ký tự
- Phải có một dòng trống sau namespace declaration

### Domain-Driven Design
- Domain: Chứa business logic và entities
- Services: Xử lý business logic phức tạp
- Interfaces: Định nghĩa contracts cho services
- Repositories: Truy cập dữ liệu
- DTOs: Data Transfer Objects 