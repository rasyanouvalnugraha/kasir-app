<div
    class="p-4 md:p-0 bg-white rounded-2xl shadow-md md:w-full w-96 md:max-w-3xl flex flex-col md:flex-row gap-8 items-center justify-center">

    <!-- Bagian Gambar -->
    <div class="hidden md:w-1/2 md:flex flex justify-center">
        <img src="{{ asset('asset/logo1.jpg') }}" alt="Login Image" class="h-96 rounded-lg shadow ">
    </div>
    <!-- Bagian Form Login -->
    <div class="w-full md:w-1/2 flex flex-col items-center">
        <img src="{{ asset('asset/logo.png') }}" alt="" class="h-14 w-14 rounded-full flex md:hidden">
        <h2 class="text-2xl font-mulish-800 text-center mb-6 text-gray-800">Login {{config('app.name')}}</h2>
        <form action="{{ route('login')}}" method="POST" class="space-y-4">
            <!-- CSRF token -->
            @csrf

            <!-- username -->
            <div>
                <label for="email" class="block text-sm font-mulish-600 text-gray-700">Username</label>
                <input type="text" id="email" name="username" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 px-4 py-2 font-mulish-600">
            </div>

            <!-- password -->
            <div>
                <label for="password" class="block text-sm font-mulish-600 text-gray-700">Password</label>
                <input type="password" id="email" name="password" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 px-4 py-2 font-mulish-600">
            </div>


            <!-- Tombol Login -->
            <button type="submit"
                class="w-full bg-indigo-600 text-white font-mulish-800 py-2 px-4 rounded-lg hover:bg-indigo-700 transition">
                Login
            </button>
            <x-alert />
        </form>
    </div>
</div>
