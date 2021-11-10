<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(Company::class, 'parent_id');
    }

    public function stations()
    {
        return $this->hasMany(Station::class);
    }
}
