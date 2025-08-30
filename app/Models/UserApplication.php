<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'paid',
        'payment_status',
        'status',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
