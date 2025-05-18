<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Selamat datang, {{ auth()->user()->name }}!</h3>
                        <p class="mt-1 text-sm text-gray-600">Anda dapat mengajukan keberatan atau melihat status pengajuan Anda di sini.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if(!auth()->user()->isAdmin())
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h4 class="text-lg font-medium text-blue-900 mb-2">Buat Pengajuan Baru</h4>
                            <p class="text-sm text-blue-700 mb-4">Ajukan keberatan baru dengan mengisi formulir pengajuan.</p>
                            <a href="{{ route('objections.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Buat Pengajuan
                            </a>
                        </div>
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h4 class="text-lg font-medium text-green-900 mb-2">Lihat Status Pengajuan</h4>
                            <p class="text-sm text-green-700 mb-4">Periksa status pengajuan keberatan yang telah Anda ajukan.</p>
                            <a href="{{ route('objections.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Lihat Status
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
