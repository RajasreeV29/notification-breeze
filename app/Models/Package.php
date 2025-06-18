<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';
    
    protected $fillable = ['package_name', 'credits','credit_due','status'];

    public function residents()
{
    return $this->hasMany(Resident::class);
}
}
