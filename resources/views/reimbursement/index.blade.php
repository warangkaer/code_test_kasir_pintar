@extends('layouts.master')

@section('title', 'Reimbursement')

@section('content')
<section class="p-4">
    <table class="table-fixed w-full bg-white">
        <thead class="bg-primary">
            <tr class="font-bold">
                <th width="10%">No.</th>
                <th>Nama Reimbursement</th>
                <th>Nama Karyawan</th>
                <th>Lampiran</th>
                <th>Status</th>
                <th>Tanggal Pengajuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-solid">
            @forelse ($reimbursements as $key => $r)
                <tr class="text-center text-dark ">
                    <td>{{ $key + 1}}</td>
                    <td>{{ ucwords($r->name) }}</td>
                    <td>{{ ucwords($r->user->name) }}</td>
                    <td>
                        <a href="/reimbursement/download/{{$r->id}}" class="bg-primary rounded p-2 text-white">Unduh</a>
                    </td>
                    <td>
                        @if ($r->status == 1)
                            <span class="text-orange-800">Diajukan</span>
                        @elseif ($r->status == 2)
                            <span class="text-green-800">Disetujui Direktur</span>
                        @elseif ($r->status == 3)
                            <span class="text-green-800">Disetujui Finance</span>
                        @elseif ($r->status == 4)
                            <span class="text-red-800">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        {{ dateToIndonesia($r->date_submission) }}
                    </td>
                    <td class="p-3">
                        @if (!in_array($r->status, [2,3,4]) && Auth::user()->degree == 'director')
                            <form method="post" action="{{ route('reimbursement.update', $r->id) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="{{ $r->status + 1 }}">
                                <button type="submit" class="inline bg-green-800 w-25 hover:bg-red-700 text-white p-2 rounded">
                                    Setujui
                                </button>
                            </form>
                        @endif
                        @if (!in_array($r->status, [1,3,4]) && Auth::user()->degree == 'finance')
                            <form method="post" action="{{ route('reimbursement.update', $r->id) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="{{ $r->status + 1 }}">
                                <button type="submit" class="inline bg-green-800 w-25 hover:bg-red-700 text-white p-2 rounded">
                                    Setujui
                                </button>
                            </form>
                        @endif
                        @if (
                            (Auth::user()->degree == 'director' && !in_array($r->status, [2,3,4]))
                            ||
                            (Auth::user()->degree == 'finance' && !in_array($r->status, [1,3,4])))
                            <form method="post" action="{{ route('reimbursement.update', $r->id) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="4">
                                <button type="submit" class="inline bg-red-800 w-25 hover:bg-red-700 text-white p-2 rounded">
                                    Tolak
                                </button>
                            </form>
                        @else
                        -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-dark">Data Kosong</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $reimbursements->links() }}
</section>
@endsection
@push('scripts')
<script>
    function updateReimbursement(id, status){


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
