@extends('layouts.master')

@section('title', 'Beranda')

@section('content')
<section class="grid grid-cols-3 gap-2">
    <div class="col-span-2 grid grid-cols rounded p-4 divide-y divide-solid">
        <div class="flex flex-row items-start">
            <img src="{{ asset('images/icons/avatar.svg') }}" class="w-2/5 inline rounded" alt="avatar">
            <div class="inline ml-4">
                <div class="grid grid-cols-6 mb-6 border-b-2 border-white">
                    <h1 class="col-span-6 text-2xl">Biodata Anda</h1>
                </div>
                <div class="grid grid-cols-6">
                    <span class="col-span-2">Nama</span>
                    <span class="col-span-4 pl-2">: {{ Auth::user()->name }}</span>
                </div>
                <div class="grid grid-cols-6">
                    <span class="col-span-2">NIP</span>
                    <span class="col-span-4 pl-2">: {{ Auth::user()->nip }}</span>
                </div>
                <div class="grid grid-cols-6">
                    <span class="col-span-2">Jabatan</span>
                    <span class="col-span-4 pl-2">: {{ Auth::user()->degree }}</span>
                </div>
                <div class="grid grid-cols-6">
                    <span class="col-span-2">Email</span>
                    <span class="col-span-4 pl-2">: {{ Auth::user()->email }}</span>
                </div>
                <div class="grid grid-cols-6">
                    <span class="col-span-2">Bergabung Pada</span>
                    <span class="col-span-4 pl-2">: {{ dateToIndonesia(Auth::user()->created_at) }}</span>
                </div>
            </div>
        </div>

        @can('createReimbursement', App\Models\Reimbursement::class)
        <div class="flex flex-col mt-8">
            <div class="text-center mt-4">
                <span class="text-2xl">Pengajuan Reimbursement</span>
            </div>
            @if (\Session::has('success'))
                <div class="bg-green-700 text-center text-white px-1 py-auto my-4 rounded">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            <form action="{{route('reimbursement.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="mt-4">
                    <x-input-label class="text-white" for="name" :value="__('Nama Reimbursement')" />
                    <x-text-input id="name" class="block mt-1 w-full text-dark"
                        type="text" name="name"
                        :value="old('name')" :placeholder="'Masukkan Nama Reimbursement'"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Date Submission -->
                <div class="relative mt-4">
                    <x-input-label class="text-white" for="date_submission" :value="__('Tanggal Pengajuan')" />
                    <div class="absolute inset-y-0 top-5 left-0 flex items-center pl-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input datepicker datepicker-format="dd-mm-yyyy" type="text" name="date_submission" id="date_submission"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-primary focus:border-primary block
                        w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary
                        dark:focus:border-primary" placeholder="Select date">
                    <x-input-error :messages="$errors->get('date_submission')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <x-input-label class="text-white" for="description" :value="__('Deskripsi')" />
                    <textarea name="description" id="description" class="w-full rounded focus:ring-primary focus:border-primary block text-dark" rows="5"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label class="text-white" for="file" :value="__('Lampiran (image/pdf)')" />
                    <input type="file" name="file">
                    <x-input-error :messages="$errors->get('file')" class="mt-2" />
                </div>
                <div class="mt-4 flex justify-end">
                    <x-primary-button class="ml-4">
                        Kirim
                    </x-primary-button>
                </div>
            </form>
        </div>
        @endcan

    </div>
    <aside class="col-span-1 rounded p-4">
        <div class="text-center text-lg border-b-2 border-secondary w-full">Berita Acara</div>

        <!-- Aside item 1 -->
        <div class="flex flex-row items-start p-2">
            <img src="{{ asset('images/user-images/bali.jpg') }}" class="inline w-20 rounded object-cover" alt="berita-acara">
            <div class="inline ml-4">
                <span class="text-xl">Family Gathering Ke Bali</span>
                <p class="text-sm text-secondary">{{ dateToIndonesia('29-09-2023') }}</p>
                <p>Acara pergi ke Bali bersama karyawan PT. Code Test...</p>
            </div>
        </div>

        <!-- Aside item 2 -->
        <div class="flex flex-row items-start p-2">
            <img src="{{ asset('images/user-images/calendar.jpg') }}" class="inline w-20 rounded object-cover" alt="berita-acara">
            <div class="inline ml-4">
                <span class="text-xl">Jadwal September 2023</span>
                <p class="text-sm text-secondary">{{ dateToIndonesia('28-09-2023') }}</p>
                <p>Jadwal terbaru untuk pegawai kode test pada bulan September 2023...</p>
            </div>
        </div>
    </aside>
</section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/datepicker.min.js"></script>
@endpush
