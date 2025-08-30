<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function userApplication()
    {
        return $this->hasMany(UserApplication::class, 'job_id');
    }


    public function userHasSubmitted($user_id)
    {
        return $this->userApplication()->where('user_id', $user_id);
    }
}
