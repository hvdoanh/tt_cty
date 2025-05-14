<x-app-layout>


    {{-- @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                title: 'Lỗi!',
                text: '{{ $message }}',
                icon: 'error',
                position: 'top-end', // Hiển thị ở góc trên bên phải
                toast: true,
                timer: 5000, // Tự động biến mất sau 5 giây
                timerProgressBar: true,
                showConfirmButton: false,
            });
        </script>
    @endif --}}

    {{-- báo lỗi đăng nhập màu đỏ 5s tự mất bên góc phải --}}
    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Lỗi!',
                text: '{{ session('error') }}',
                icon: 'error',
                position: 'top-end', // Hiển thị ở góc trên bên phải
                toast: true,
                timer: 5000, // Tự động biến mất sau 5 giây
                timerProgressBar: true,
                showConfirmButton: false,
            });
        </script>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
