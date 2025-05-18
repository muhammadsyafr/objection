<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Pengajuan Keberatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('objections.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="full_name" :value="__('Nama Lengkap')" />
                            <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
                        </div>

                        <div>
                            <x-input-label for="nik" :value="__('NIK')" />
                            <x-text-input id="nik" name="nik" type="text" class="mt-1 block w-full" :value="old('nik')" required maxlength="16" />
                            <x-input-error class="mt-2" :messages="$errors->get('nik')" />
                        </div>

                        <div>
                            <x-input-label for="phone_number" :value="__('Nomor Telepon')" />
                            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                        </div>

                        <div>
                            <x-input-label for="passport_number" :value="__('Nomor Paspor')" />
                            <x-text-input id="passport_number" name="passport_number" type="text" class="mt-1 block w-full" :value="old('passport_number')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('passport_number')" />
                        </div>

                        <div>
                            <x-input-label for="address" :value="__('Alamat')" />
                            <textarea id="address" name="address" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('address') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Status</option>
                                <option value="pejabat_imigrasi" {{ old('status') == 'pejabat_imigrasi' ? 'selected' : '' }}>Pejabat Imigrasi</option>
                                <option value="penjamin" {{ old('status') == 'penjamin' ? 'selected' : '' }}>Penjamin</option>
                                <option value="pemegang_paspor" {{ old('status') == 'pemegang_paspor' ? 'selected' : '' }}>Pemegang Paspor</option>
                                <option value="pemilik_tempat_tinggal" {{ old('status') == 'pemilik_tempat_tinggal' ? 'selected' : '' }}>Pemilik tempat tinggal</option>
                                <option value="pemilik_alat_angkut" {{ old('status') == 'pemilik_alat_angkut' ? 'selected' : '' }}>Pemilik alat angkut</option>
                                <option value="lainnya" {{ old('status') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <div>
                            <x-input-label for="document" :value="__('Upload Dokumen (PDF/DOC/DOCX)')" />
                            <input type="file" id="document" name="document" class="mt-1 block w-full" accept=".pdf,.doc,.docx" required />
                            <x-input-error class="mt-2" :messages="$errors->get('document')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Deskripsi Keluhan')" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="5" required>{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Kirim Pengajuan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 