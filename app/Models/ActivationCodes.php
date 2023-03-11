<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ActivationCodes extends Model
{
    use HasFactory;
    protected $table = 'activation_codes';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'activationCode',
        'status',
    ];

    public static function getUsedCodes()
    {
        return DB::select("SELECT activation_codes.activationCode, users.userName, activation_codes.status, activation_codes.created_at
                            FROM users INNER JOIN activation_codes ON users.activationCode = activation_codes.activationCode
                            WHERE (((activation_codes.status)=1))");
    }

    public static function countUsedCodes()
    {
        return DB::table('activation_codes')->where('status', 1)->count();
    }

    public static function countUnusedCodes()
    {
        return DB::table('activation_codes')->where('status', 0)->count();
    }
}
