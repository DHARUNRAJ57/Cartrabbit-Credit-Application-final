<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Controllers\UserProfileController;
class ApplyForLoanModel extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Adjust the method signatures to accept an associative array instead of ApplyForLoanModel

}
