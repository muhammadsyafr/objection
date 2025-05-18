<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Pengajuan Keberatan') }}
            </h2>
            @if(!auth()->user()->isAdmin())
                <a href="{{ route('objections.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Buat Pengajuan Baru
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user()->isAdmin())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <form action="{{ route('objections.filter') }}" method="GET" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <x-input-label for="name" :value="__('Nama')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="request('name')" />
                                </div>
                                <div>
                                    <x-input-label for="start_date" :value="__('Tanggal Mulai')" />
                                    <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="request('start_date')" />
                                </div>
                                <div>
                                    <x-input-label for="end_date" :value="__('Tanggal Akhir')" />
                                    <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="request('end_date')" />
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <x-primary-button>{{ __('Filter') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($objections->isEmpty())
                        <p class="text-center text-gray-500">Tidak ada pengajuan keberatan.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($objections as $objection)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $objection->full_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $objection->nik }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($objection->verification_status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($objection->verification_status === 'approved') bg-green-100 text-green-800
                                                    @else bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($objection->verification_status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $objection->created_at->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('objections.show', $objection) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                                @if(auth()->user()->isAdmin() && $objection->verification_status === 'pending')
                                                    <form action="{{ route('objections.update-status', $objection) }}" method="POST" class="inline-block ml-2">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="verification_status" value="approved">
                                                        <button type="submit" class="text-green-600 hover:text-green-900">Terima</button>
                                                    </form>
                                                    <form action="{{ route('objections.update-status', $objection) }}" method="POST" class="inline-block ml-2">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="verification_status" value="rejected">
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Tolak</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $objections->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 