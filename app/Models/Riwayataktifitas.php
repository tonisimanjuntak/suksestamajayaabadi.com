<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;


class Riwayataktifitas extends Model
{
    use HasFactory;
    protected $table = 'riwayataktifitas';
    protected $keyType = 'int';
}
