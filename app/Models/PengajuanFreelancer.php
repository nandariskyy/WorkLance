<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanFreelancer extends Model
{
    protected $table = 'pengajuan_freelancer';
    protected $primaryKey = 'id_pengajuan';
    public $timestamps = false;
    protected $guarded = [];
}
