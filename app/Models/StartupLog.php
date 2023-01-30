<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartupLog extends Model
{
    use HasFactory;
    protected $table = 'startup_logs';
    public $timestamps = true;
    protected $primaryKey = 'transID';
    protected $fillable = [
        'id',
        'sponsorID',
        'addedUser',
        'addedBy',
        'totalRebate',
        'totalStars',
    ];
}
