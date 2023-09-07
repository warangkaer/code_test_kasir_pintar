<x-guest-layout>
    <form method="POST" action="{{ isset($user) ? route('users.update', $user->id) : route('register') }}">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif

        @if (\Session::has('success'))
            <div class="bg-green-700 text-center text-white px-1 py-auto my-4 rounded">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full"
                type="text" name="name"
                :value="isset($user) ? $user->name : old('name')" :placeholder="'Masukkan Nama Lengkap Pengguna'"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email"
                :value="isset($user) ? $user->email : old('email')" :placeholder="'Masukkan Email Pengguna'"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Nip -->
        <div class="mt-4">
            <x-input-label for="nip" :value="__('NIP')" />
            <x-text-input id="nip" class="block mt-1 w-full"
                type="text" name="nip"
                :value="isset($user) ? $user->nip : old('nip')" :placeholder="'Masukkan NIP Pengguna'"
                required autofocus autocomplete="nip" />
            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
        </div>

        <!-- Degree -->
        <div class="mt-4">
            <x-input-label for="degree" :value="__('Jabatan')" />
            <select
                class='border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                        focus:border-secondary focus:ring-secondary rounded-md shadow-sm
                        block mt-1 w-full'
                name="degree" id="degree">
                <option>Pilih Jabatan</option>
                <option value="director" {{isset($user) && $user->degree == 'director' ? 'selected' : ''}}>Director</option>
                <option value="finance" {{isset($user) && $user->degree == 'finance' ? 'selected' : ''}}>Finance</option>
                <option value="staff"  {{isset($user) && $user->degree == 'staff' ? 'selected' : ''}}>Staff</option>
            </select>
            <x-input-error :messages="$errors->get('degree')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            :placeholder="'Masukkan Password'"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation"
                            :placeholder="'Masukkan Konfirmasi Password'"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="/users" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent
                            rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase
                            tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700
                            dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none
                            focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                            transition ease-in-out duration-150">
                Kembali
            </a>
            <x-primary-button class="ml-4">
                {{ isset($user) ? 'Simpan' : 'Daftar'}}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
