<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Resident extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['res_name', 'email','phone','gender','status','package_id'];


public function package()
{
    return $this->belongsTo(Package::class)->withDefault('sed quo');
}

}
