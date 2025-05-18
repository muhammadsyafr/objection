<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Selamat datang, {{ auth()->user()->name }}!</h3>
                        <p class="mt-1 text-sm text-gray-600">Anda dapat mengelola pengajuan keberatan di sini.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h4 class="text-lg font-medium text-blue-900 mb-2">Total Pengajuan</h4>
                            <p class="text-3xl font-bold text-blue-700">{{ \App\Models\Objection::count() }}</p>
                        </div>

                        <div class="bg-yellow-50 p-6 rounded-lg">
                            <h4 class="text-lg font-medium text-yellow-900 mb-2">Menunggu Verifikasi</h4>
                            <p class="text-3xl font-bold text-yellow-700">{{ \App\Models\Objection::where('verification_status', 'pending')->count() }}</p>
                        </div>

                        <div class="bg-green-50 p-6 rounded-lg">
                            <h4 class="text-lg font-medium text-green-900 mb-2">Diterima</h4>
                            <p class="text-3xl font-bold text-green-700">{{ \App\Models\Objection::where('verification_status', 'approved')->count() }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('objections.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Kelola Pengajuan
                            </a>
                            <a href="{{ route('objections.filter') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Filter Pengajuan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 