<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ActivationCode extends Model
{
    use HasFactory;
    protected $table = 'activation_codes';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'activationCode',
        'status',
    ];

    public static function codeStatus($code)
    {
        DB::table('activation_codes')
                ->where('activationCode', $code)
                ->update(array('status' => 1));
    }
}
