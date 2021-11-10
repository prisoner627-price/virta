<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Station extends Model
{
    use HasFactory;
    use SpatialTrait;

    protected $spatialFields = [
        'location',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
