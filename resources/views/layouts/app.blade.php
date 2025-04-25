<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    {{-- tailwind css via cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- icon kasir --}}
    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/x-icon" class="rounded-full">
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=National+Park:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
</head>

<body class="bg-gray-200">
    <main class="flex flex-1">
        <div class="m-4">
            @include('components.navbar-desktop')
        </div>
        @include('components.alert')
        @include('components.tablebarang')
    </main>

    @if (session('messageCreate'))
        <script>
            const messageCreate = "{{ session('messageCreate') }}";
            if (messageCreate == 'success') {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Data berhasil ditambahkan',
                    icon: 'success',
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/app';
                    }
                });
            }
        </script>
    @endif
    @if (session('messageEdit'))
        <script>
            const messageCreate = "{{ session('messageEdit') }}";
            if (messageCreate == 'success') {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Data berhasil diupdate',
                    icon: 'success',
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/app';
                    }
                });
            }
        </script>
    @endif
    @if (session('messageDelete'))
        <script>
            const messageCreate = "{{ session('messageDelete') }}";
            if (messageCreate == 'success') {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Data berhasil dihapus',
                    icon: 'success',
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/app';
                    }
                });
            }
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
