<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class StartupSavings extends Model
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

    public static function logs($id)
    {
        return DB::select("WITH RECURSIVE downline AS
                    (select id, addedUser, addedBy, totalRebate, totalStars, created_at from startup_logs WHERE id = '$id'
                    UNION ALL SELECT s.id, s.addedUser, s.addedBy, s.totalRebate, s.totalStars, s.created_at FROM downline d,
                    startup_logs s WHERE s.sponsorID=d.id)
                    SELECT * from downline;");
    }

    public static function totalStartupRebate($id)
    {
        $levelOneCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                            FROM users where id='$id' UNION ALL
                            SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
                            FROM downline d, users u WHERE u.sponsorID=d.id
                        )
                        SELECT COUNT(id)as multiplier FROM downline WHERE level=1");

        $levelTwoCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                            FROM users where id='$id' UNION ALL
                            SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
                            FROM downline d, users u WHERE u.sponsorID=d.id
                        )
                        SELECT COUNT(id) as multiplier FROM downline WHERE level=2 ");

        $levelThreeCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                            FROM users where id='$id' UNION ALL
                            SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
                            FROM downline d, users u WHERE u.sponsorID=d.id
                        )
                        SELECT COUNT(id) as multiplier FROM downline WHERE level=3 ");

        $levelFourCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                            FROM users where id='$id' UNION ALL
                            SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
                            FROM downline d, users u WHERE u.sponsorID=d.id
                        )
                        SELECT COUNT(id) as multiplier FROM downline WHERE level=4 ");

        foreach($levelOneCount as $count1)
        {
            $levelOneMultiplier = $count1->multiplier;
        }
        foreach($levelTwoCount as $count2)
        {
            $levelTwoMultiplier = $count2->multiplier;
        }
        foreach($levelThreeCount as $count3)
        {
            $levelThreeMultiplier = $count3->multiplier;
        }
        foreach($levelFourCount as $count4)
        {
            $levelFourMultiplier = $count4->multiplier;
        }
        $levelOneSubTotalRebate = $levelOneMultiplier*50;
        $levelTwoSubTotalRebate = $levelTwoMultiplier*8;
        $levelThreeSubTotalRebate = $levelThreeMultiplier*16;
        $levelFourSubTotalRebate = $levelFourMultiplier*16;
        $totalRebate = $levelOneSubTotalRebate + $levelTwoSubTotalRebate + $levelThreeSubTotalRebate + $levelFourSubTotalRebate;

        return $totalRebate;
    }

    public static function totalStartupStars($id)
    {
        $levelOneCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                            FROM users where id='$id' UNION ALL
                            SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
                            FROM downline d, users u WHERE u.sponsorID=d.id
                        )
                        SELECT COUNT(id)as multiplier FROM downline WHERE level=1");

        $levelTwoCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                            FROM users where id='$id' UNION ALL
                            SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
                            FROM downline d, users u WHERE u.sponsorID=d.id
                        )
                        SELECT COUNT(id) as multiplier FROM downline WHERE level=2 ");

        $levelThreeCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                            FROM users where id='$id' UNION ALL
                            SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
                            FROM downline d, users u WHERE u.sponsorID=d.id
                        )
                        SELECT COUNT(id) as multiplier FROM downline WHERE level=3 ");

        $levelFourCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                            FROM users where id='$id' UNION ALL
                            SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
                            FROM downline d, users u WHERE u.sponsorID=d.id
                        )
                        SELECT COUNT(id) as multiplier FROM downline WHERE level=4 ");

        foreach($levelOneCount as $count1)
        {
            $levelOneMultiplier = $count1->multiplier;
        }
        foreach($levelTwoCount as $count2)
        {
            $levelTwoMultiplier = $count2->multiplier;
        }
        foreach($levelThreeCount as $count3)
        {
            $levelThreeMultiplier = $count3->multiplier;
        }
        foreach($levelFourCount as $count4)
        {
            $levelFourMultiplier = $count4->multiplier;
        }
        $totalStars = $levelOneMultiplier + $levelTwoMultiplier + $levelThreeMultiplier + ($levelFourMultiplier*2);

        return $totalStars;
    }

}
