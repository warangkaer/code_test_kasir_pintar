@extends('layouts.master')

@section('title', 'Pengguna')

@section('content')
<section class="p-4">

    <div class="flex flex-row justify-end my-4">
        <a href="/register" class="bg-primary hover:bg-secondary text-white p-2 rounded">Tambah Pengguna</a>
    </div>
    <table class="table-fixed w-full bg-white">
        <thead class="bg-primary">
            <tr class="font-bold">
                <th width="10%">No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>NIP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-solid">
            @forelse ($users as $key => $user)
                <tr class="text-center text-dark ">
                    <td>{{ $key + 1}}</td>
                    <td>{{ ucwords($user->name) }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucwords($user->degree) }}</td>
                    <td>{{ $user->nip }}</td>
                    <td class="p-3">
                        <a href="/users/{{$user->id}}/edit">
                            <button class="inline bg-green-800 w-25 hover:bg-green-700 text-white p-2 rounded">
                                ubah
                            </button>
                        </a>
                        <button type="submit" class="inline bg-red-800 w-25 hover:bg-red-700 text-white p-2 rounded" onclick="deleteUser({{$user->id}}, {{$user->nip}})">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Data Kosong</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>
@endsection
@push('scripts')
<script>
    function deleteUser(id, nip){


        Swal.fire({
        title: `Hapus`,
        text: `User dengan NIP ${nip} akan dihapus`,
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(`/users/${id}`, {
                method : 'DELETE',
                headers : {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(response.statusText)
                }
            })
            .catch(error => {
                Swal.showValidationMessage(
                `Request failed: ${error}`
                )
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil !',
                cancelButtonText: 'Tutup'
            })

            setTimeout(() => {
                Swal.close();
                window.location.reload();
            }, 2000)
        }
        })
    }
</script>

@endpush
