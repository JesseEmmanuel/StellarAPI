<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class EncashmentLogs extends Model
{
    use HasFactory;
    protected $table = 'encashment_logs';
    public $timestamps = true;
    protected $primaryKey = 'logID';
    protected $fillable = [
        'userID',
        'title',
        'description',
        'encashment',
        'rebateBalance',
    ];
}
