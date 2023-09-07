<?php
namespace App\DTO;

use App\Models\Reimbursement;
use App\Http\Requests\UpdateStatusReimbursementRequest;
use Illuminate\Support\Facades\Auth;

class ReimbursementDTO{
    public static function create(array $data): Reimbursement
    {
        $reimbursement = Reimbursement::create([
            'name' => $data['name'],
            'user_id' => $data['user_id'],
            'description' => $data['description'],
            'date_submission' => $data['date_submission'],
            'status' => $data['status'],
            'filename' => $data['filename']
        ]);

        return $reimbursement;
    }

    public static function updateStatus(Reimbursement $reimbursement, UpdateStatusReimbursementRequest $data): Reimbursement
    {
        $reimbursement->update(['status' => $data->status]);

        return $reimbursement;
    }
}
?>
