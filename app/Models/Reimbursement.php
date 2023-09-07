<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;
    protected $table = 'reimbursements';
    protected $fillable = ['name', 'user_id', 'description', 'filename', 'status', 'date_submission'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
