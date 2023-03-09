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

    public static function getAll()
    {
        return DB::select("SELECT users.activationCode, startupsavings.fullName, users.role, startupsavings.userID
        FROM startupsavings INNER JOIN users ON startupsavings.userID = users.id
        WHERE (((users.role)='user'))");
    }

    public static function startups()
    {
        return DB::select("SELECT startupsavings.userID, startupsavings.fullName, users.IsUpgraded, users.activationCode, users.role
        FROM startupsavings INNER JOIN users ON startupsavings.userID = users.id
        WHERE (((users.IsUpgraded)=0) AND ((users.role)='user'))");
    }

    public static function logs($id)
    {
        return DB::select("WITH RECURSIVE downline AS
                         (select id, title, description, totalRebate, created_at from genealogy_logs WHERE id = '1'
                            UNION ALL SELECT g.id, g.title, g.description, g.totalRebate, g.created_at FROM downline d,
                            genealogy_logs g WHERE g.sponsorID=d.id)
                            SELECT DISTINCT * from downline order by created_at desc");
    }

    public static function DirectReferrals($id)
    {
        return DB::select("WITH RECURSIVE downline AS(
            SELECT userID, fullName, 0 as level
            FROM startupsavings  where userID='$id' UNION ALL
            SELECT ss.userID, ss.fullName, d.level+1
            FROM downline d, startupsavings ss WHERE ss.sponsorID=d.userID
        )
        SELECT downline.userID, downline.fullName, startupdata.stars FROM downline inner join startupdata on downline.userID=startupdata.id where level=1");
    }

    public static function levelCount($id, $levelNum)
    {
        $lvlOne = DB::select("WITH RECURSIVE downline AS(
            SELECT userID, 0 as level
            FROM startupsavings where userID='$id' UNION ALL
            SELECT s.userID, d.level+1
            FROM downline d, startupsavings s WHERE s.sponsorID=d.userID
        )
        SELECT COUNT(userID)as count FROM downline WHERE level=$levelNum");

        foreach($lvlOne as $countresult)
        {
            $lvlOneCount = $countresult->count;
        }
        return $lvlOneCount;
    }

    public static function totalStartupRebate($id)
    {
        $levelOneCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT userID, 0 as level
                            FROM startupsavings where userID='$id' UNION ALL
                            SELECT s.userID, d.level+1
                            FROM downline d, startupsavings s WHERE s.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=1");

        $levelTwoCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT userID, 0 as level
                            FROM startupsavings where userID='$id' UNION ALL
                            SELECT s.userID, d.level+1
                            FROM downline d, startupsavings s WHERE s.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=2");

        $levelThreeCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT userID, 0 as level
                            FROM startupsavings where userID='$id' UNION ALL
                            SELECT s.userID, d.level+1
                            FROM downline d, startupsavings s WHERE s.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=3");

        $levelFourCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT userID, 0 as level
                            FROM startupsavings where userID='$id' UNION ALL
                            SELECT s.userID, d.level+1
                            FROM downline d, startupsavings s WHERE s.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=4");

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
                            SELECT userID, 0 as level
                            FROM startupsavings where userID='$id' UNION ALL
                            SELECT s.userID, d.level+1
                            FROM downline d, startupsavings s WHERE s.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=1");

        $levelTwoCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT userID, 0 as level
                            FROM startupsavings where userID='$id' UNION ALL
                            SELECT s.userID, d.level+1
                            FROM downline d, startupsavings s WHERE s.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=2");

        $levelThreeCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT userID, 0 as level
                            FROM startupsavings where userID='$id' UNION ALL
                            SELECT s.userID, d.level+1
                            FROM downline d, startupsavings s WHERE s.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=3");

        $levelFourCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT userID, 0 as level
                            FROM startupsavings where userID='$id' UNION ALL
                            SELECT s.userID, d.level+1
                            FROM downline d, startupsavings s WHERE s.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=4");

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

    public static function checkSlot($id)
    {
        return DB::select("WITH RECURSIVE downline AS(
            SELECT userID, 0 as level
            FROM startupsavings where userID='$id' UNION ALL
            SELECT s.userID, d.level+1
            FROM downline d, startupsavings s WHERE s.sponsorID=d.userID
        )
        SELECT COUNT(userID)as slots FROM downline WHERE level=1");
    }

    public static function newStartupUser($data)
    {
        $userID = $data['userID'];
        $sponsorID = $data['sponsorID'];
        $fullName = $data['fullName'];
        $cycleNum = $data['cycle'];
        DB::insert("INSERT into startupsavings (userID, sponsorID, fullName, cycle)
                    values (?,?,?,?)",
                    [
                        $userID, $sponsorID, $fullName, $cycleNum
                    ]);
    }


}
