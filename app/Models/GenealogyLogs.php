<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class GenealogyLogs extends Model
{
    use HasFactory;
    protected $table = 'genealogy_logs';
    public $timestamps = true;
    protected $primaryKey = 'transID';
    protected $fillable = [
        'id',
        'sponsorID',
        'title',
        'description',
        'totalRebate',
    ];
}
