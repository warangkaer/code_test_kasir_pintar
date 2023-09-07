<?php

namespace App\Http\Controllers;

use App\DTO\ReimbursementDTO;
use App\Http\Requests\StoreReimbusementRequest;
use App\Http\Requests\UpdateStatusReimbursementRequest;
use Illuminate\View\View;
use App\Models\Reimbursement;
use App\Services\ReimbursementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReimbursementController extends Controller
{
    protected $viewDir = 'reimbursement.';

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        Session::flash('menu-active', 'reimbursement');

        $reimbursements = ReimbursementService::getReimbursements();

        return view($this->viewDir . 'index', compact('reimbursements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReimbusementRequest $request): RedirectResponse
    {
        $reimbursement = ReimbursementService::create($request);

        if(!$reimbursement) return redirect()->back()->withErrors('message', 'Gagal Dalam Mengirimkan Reimbursement!');
        return redirect()->back()->with('success', 'Berhasil Mengirimkan Reimbursement!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusReimbursementRequest $request, Reimbursement $reimbursement): RedirectResponse
    {
        $this->authorize('editUpdateReimbursement', Reimbursement::class);

        $reimbursement = ReimbursementDTO::updateStatus($reimbursement, $request);

        if(!$reimbursement) return redirect()->back()->withErrors('message', 'Gagal Dalam Mengupdate Reimbursement!');
        return redirect()->back()->with('success', 'Berhasil Mengupdate Reimbursement!');
    }

    public function downloadFile(string $id): BinaryFileResponse
    {
        $reimbursement = Reimbursement::find($id);
        $path = storage_path('app/reimbursement/'. $reimbursement->filename);
        return response()->download($path);
    }
}
