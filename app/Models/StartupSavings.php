<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class StartupSavings extends Model
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
        'totalStars',
    ];

    public static function logs($id)
    {
        return DB::select("WITH RECURSIVE downline AS
                    (select id, title, description, totalRebate, totalStars, created_at from genealogy_logs WHERE id = '$id'
                    UNION ALL SELECT g.id, g.title, g.description, g.totalRebate, g.totalStars, g.created_at FROM downline d,
                    genealogy_logs g WHERE g.sponsorID=d.id)
                    SELECT * from downline;");
    }

    public static function DirectReferrals($id)
    {
        return DB::select("WITH RECURSIVE downline AS(
            SELECT id, firstName, middleName, lastName, activationCode, email, 0 as level
            FROM users where id='$id' UNION ALL
            SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, u.email, d.level+1
            FROM downline d, users u WHERE u.sponsorID=d.id
        )
        SELECT * FROM downline WHERE level=1");
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
        $levelThreeSubTotalRebate = $levelThreeMultiplier*6;
        $levelFourSubTotalRebate = $levelFourMultiplier*14;
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
        $totalStars = $levelTwoMultiplier + $levelThreeMultiplier + ($levelFourMultiplier*2);

        return $totalStars;
    }

    public static function updateStartup($id, $rebate, $stars, $encashment, $rebateBalance)
    {
        return DB::table('startupdata')
                    ->where('id', $id)
                    ->limit(1)
                    ->update(array('rebate' => $rebate,
                                    'stars' => $stars,
                                    'encashment' => $encashment,
                                    'rebateBalance' => $rebateBalance
                            ));
    }

    public static function getEncashment($id)
    {
        return DB::table('startupdata')
                    ->select('encashment')
                    ->where('id', $id)
                    ->first();
    }

    public static function getRebateBalance($id)
    {
        return DB::table('startupdata')
                    ->select('rebateBalance')
                    ->where('id', $id)
                    ->get();
    }

    public static function getStars($id)
    {
        return DB::table('startupdata')
                    ->select('stars')
                    ->where('id', $id)
                    ->get();
    }

    public static function newStartupData($data)
    {
        $id = $data['id'];
        $rebate = $data['rebate'];
        $stars = $data['stars'];
        $encashment = $data['encashment'];
        $rebateBalance = $data['rebateBalance'];
        DB::insert("INSERT into startupdata (id, rebate, stars, encashment, rebateBalance)
                    values (?, ?, ?, ?, ?)",
                    [
                        $id, $rebate, $stars, $encashment, $rebateBalance
                    ]);
    }


}
