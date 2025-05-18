<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengajuan Keberatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pengaju</h3>
                            <dl class="space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $objection->full_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">NIK</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $objection->nik }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Nomor Telepon</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $objection->phone_number }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Nomor Paspor</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $objection->passport_number }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $objection->address }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($objection->status) }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Pengajuan</h3>
                            <dl class="space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status Verifikasi</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($objection->verification_status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($objection->verification_status === 'approved') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($objection->verification_status) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tanggal Pengajuan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $objection->created_at->format('d/m/Y H:i') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Deskripsi Keluhan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $objection->description }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Dokumen</dt>
                                    <dd class="mt-1">
                                        @if($objection->document_path)
                                            <a href="{{ asset('storage/' . $objection->document_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                                Lihat Dokumen
                                            </a>
                                        @else
                                            <span class="text-gray-500">Tidak ada dokumen</span>
                                        @endif
                                    </dd>
                                </div>
                                @if($objection->admin_notes)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Catatan Admin</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $objection->admin_notes }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>
                    </div>

                    @if(auth()->user()->isAdmin() && $objection->verification_status === 'pending')
                        <div class="mt-8 border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Update Status</h3>
                            <form action="{{ route('objections.update-status', $objection) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PATCH')
                                
                                <div>
                                    <x-input-label for="verification_status" :value="__('Status Verifikasi')" />
                                    <select id="verification_status" name="verification_status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="approved">Diterima</option>
                                        <option value="rejected">Ditolak</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('verification_status')" />
                                </div>

                                <div>
                                    <x-input-label for="admin_notes" :value="__('Catatan Admin')" />
                                    <textarea id="admin_notes" name="admin_notes" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('admin_notes') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('admin_notes')" />
                                </div>

                                <div class="flex justify-end">
                                    <x-primary-button>{{ __('Update Status') }}</x-primary-button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 