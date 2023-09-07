<?php
namespace App\Services;

use App\DTO\ReimbursementDTO;
use App\Models\Reimbursement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\CursorPaginator;

class ReimbursementService{
    public static function getReimbursements(): CursorPaginator
    {
        $reimbursement = Reimbursement::with('user:id,name,nip')
                                    ->select('id', 'name', 'description','date_submission', 'filename', 'status', 'user_id')
                                    ->when(Auth::user()->degree == 'director', function($q) {
                                        return $q->where('status', 1);
                                    })
                                    ->when(Auth::user()->degree == 'finance', function($q) {
                                        return $q->where('status', 2);
                                    })
                                    ->when(Auth::user()->degree == 'staff', function($q) {
                                        return $q->where('user_id', Auth::id());
                                    })
                                    ->orderBy('id')
                                    ->cursorPaginate(20);

        return $reimbursement;
    }

    public static function create(object $data): Reimbursement
    {
        $fileextension  = $data->file->getClientOriginalExtension();
        $filename       = time() . "-" . Auth::id() . "-reimbursement." . $fileextension;
        $data->file->storeAs('reimbursement', $filename);

        $data = [
            'name' => $data->name,
            'user_id' => Auth::id(),
            'date_submission' => date('Y-m-d', strtotime($data->date_submission)),
            'description' => $data->description,
            'status' => 1, // 1 is status for in submission
            'filename' => $filename
        ];

        $reimbursementDTO = ReimbursementDTO::create($data);

        return $reimbursementDTO;
    }
}
?>
