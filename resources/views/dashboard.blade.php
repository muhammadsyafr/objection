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
                    @if(Auth::user()->isAdmin())
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Daftar Pengajuan Keberatan</h3>
                            <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2">
                                <input type="text" name="name" value="{{ request('name') }}" placeholder="Cari nama..." class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                                <select name="verification_status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Semua Verifikasi</option>
                                    <option value="pending" {{ request('verification_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ request('verification_status') == 'approved' ? 'selected' : '' }}>Terverifikasi</option>
                                    <option value="rejected" {{ request('verification_status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    Filter
                                </button>
                            </form>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NIK</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Verifikasi</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @if(isset($objections) && $objections->count() > 0)
                                    @foreach($objections as $objection)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $objection->full_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $objection->nik }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                            {{ $objection->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                               ($objection->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                               'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($objection->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                            {{ $objection->verification_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                               ($objection->verification_status === 'verified' ? 'bg-green-100 text-green-800' : 
                                                               'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($objection->verification_status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $objection->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('objections.show', $objection) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                                @if($objection->verification_status === 'pending')
                                                <form action="{{ route('objections.update-status', $objection) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="verification_status" value="verified">
                                                    <button type="submit" class="text-green-600 hover:text-green-900">Verifikasi</button>
                                                </form>
                                                <form action="{{ route('objections.update-status', $objection) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="verification_status" value="rejected">
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Tolak</button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-center">
                                            Belum ada pengajuan keberatan
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="text-center">
                        <h3 class="text-lg font-semibold mb-4">Selamat Datang di Sistem Pengajuan Keberatan</h3>
                        <p class="mb-4">Silakan ajukan keberatan Anda dengan mengklik tombol di bawah ini.</p>
                        <a href="{{ route('objections.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Buat Pengajuan
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>