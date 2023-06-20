<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'register';

    protected $fillable = ['nama','prodi','no_hp','no_hp2','asal_sekolah','domisili','instagram','facebook','email','tahun_lulus','created_at'];
}
