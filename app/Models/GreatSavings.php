<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class GreatSavings extends Model
{
    use HasFactory;

    public static function getAll()
    {
        return DB::select("SELECT users.activationCode, greatsavings.fullName, users.role, greatsavings.userID
        FROM greatsavings INNER JOIN users ON greatsavings.userID = users.id
        WHERE (((users.role)='user'))");
    }

    public static function DirectReferrals($id)
    {
        return DB::select("WITH RECURSIVE downline AS(
            SELECT id, firstName, middleName, lastName, activationCode, email, IsUpgraded, 0 as level
            FROM users where id='$id' UNION ALL
            SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, u.email, u.IsUpgraded, d.level+1
            FROM downline d, users u WHERE u.sponsorID=d.id
        )
        SELECT * FROM downline WHERE level=1 AND IsUpgraded=1");
    }

    public static function CheckUser($id)
    {
        return DB::table('users')
                ->where('id', $id)
                ->where('IsUpgraded', 1)
                ->first();
    }

    public static function LevelTwoCheck($id)
    {
        return DB::select("WITH RECURSIVE downline AS(
            SELECT id, firstName, middleName, lastName, activationCode, 0 as level
            FROM users where id='$id' UNION ALL
            SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
            FROM downline d, users u WHERE u.sponsorID=d.id
        )
        SELECT COUNT(id) as counter FROM downline WHERE level=2");
    }

    public static function PromoteToGreatSavings($id)
    {
        return DB::table('users')
                    ->where('id', $id)
                    ->limit(1)
                    ->update(array('IsUpgraded' => 1));
    }

    public static function newGreatSaveData($data)
    {
        $id = $data['id'];
        $rebate = $data['rebate'];
        $stars = $data['stars'];
        $encashment = $data['encashment'];
        $rebateBalance = $data['rebateBalance'];
        DB::insert("INSERT into greatsavedata (id, rebate, stars, encashment, rebateBalance)
                    values (?, ?, ?, ?, ?)",
                    [
                        $id, $rebate, $stars, $encashment, $rebateBalance
                    ]);
    }

    public static function levelCount($id, $levelNum)
    {
        $lvlOne = DB::select("WITH RECURSIVE downline AS(
            SELECT userID, 0 as level
            FROM greatsavings where userID='$id' UNION ALL
            SELECT g.userID, d.level+1
            FROM downline d, greatsavings g WHERE g.sponsorID=d.userID
        )
        SELECT COUNT(userID)as count FROM downline WHERE level=$levelNum");

        foreach($lvlOne as $countresult)
        {
            $lvlOneCount = $countresult->count;
        }
        return $lvlOneCount;
    }

    public static function totalGreatSaveRebate($id)
    {
        $levelOneCount = DB::select("WITH RECURSIVE downline AS(
                                SELECT userID, 0 as level
                                FROM greatsavings where userID='$id' UNION ALL
                                SELECT g.userID, d.level+1
                                FROM downline d, greatsavings g WHERE g.sponsorID=d.userID
                            )
                            SELECT COUNT(userID)as multiplier FROM downline WHERE level=1");

        $levelTwoCount = DB::select("WITH RECURSIVE downline AS(
                                SELECT userID, 0 as level
                                FROM greatsavings where userID='$id' UNION ALL
                                SELECT g.userID, d.level+1
                                FROM downline d, greatsavings g WHERE g.sponsorID=d.userID
                            )
                            SELECT COUNT(userID)as multiplier FROM downline WHERE level=2");

        $levelThreeCount = DB::select("WITH RECURSIVE downline AS(
                                SELECT userID, 0 as level
                                FROM greatsavings where userID='$id' UNION ALL
                                SELECT g.userID, d.level+1
                                FROM downline d, greatsavings g WHERE g.sponsorID=d.userID
                            )
                            SELECT COUNT(userID)as multiplier FROM downline WHERE level=3");

        $levelFourCount = DB::select("WITH RECURSIVE downline AS(
                                SELECT userID, 0 as level
                                FROM greatsavings where userID='$id' UNION ALL
                                SELECT g.userID, d.level+1
                                FROM downline d, greatsavings g WHERE g.sponsorID=d.userID
                            )
                            SELECT COUNT(userID)as multiplier FROM downline WHERE level=4");

        $levelFiveCount = DB::select("WITH RECURSIVE downline AS(
                                SELECT userID, 0 as level
                                FROM greatsavings where userID='$id' UNION ALL
                                SELECT g.userID, d.level+1
                                FROM downline d, greatsavings g WHERE g.sponsorID=d.userID
                            )
                            SELECT COUNT(userID)as multiplier FROM downline WHERE level=5");


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
        foreach($levelFiveCount as $count5)
        {
            $levelFiveMultiplier = $count5->multiplier;
        }

        $levelOneSubTotalRebate = $levelOneMultiplier*500;
        $levelTwoSubTotalRebate = $levelTwoMultiplier*48;
        $levelThreeSubTotalRebate = $levelThreeMultiplier*48;
        $levelFourSubTotalRebate = $levelFourMultiplier*96;
        $levelFiveSubTotalRebate = $levelFiveMultiplier*144;
        $totalRebate = $levelOneSubTotalRebate + $levelTwoSubTotalRebate + $levelThreeSubTotalRebate + $levelFourSubTotalRebate + $levelFiveSubTotalRebate;

        return $totalRebate;
    }

    public static function totalGreatSaveStars($id)
    {
        $levelOneCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT userID, 0 as level
                            FROM greatsavings where userID='$id' UNION ALL
                            SELECT g.userID, d.level+1
                            FROM downline d, greatsavings g WHERE g.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=1");

        $levelTwoCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT userID, 0 as level
                            FROM greatsavings where userID='$id' UNION ALL
                            SELECT g.userID, d.level+1
                            FROM downline d, greatsavings g WHERE g.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=2");

        $levelThreeCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT userID, 0 as level
                            FROM greatsavings where userID='$id' UNION ALL
                            SELECT g.userID, d.level+1
                            FROM downline d, greatsavings g WHERE g.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=3");

        $levelFourCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT userID, 0 as level
                            FROM greatsavings where userID='$id' UNION ALL
                            SELECT g.userID, d.level+1
                            FROM downline d, greatsavings g WHERE g.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=4");

        $levelFiveCount = DB::select("WITH RECURSIVE downline AS(
                            SELECT userID, 0 as level
                            FROM greatsavings where userID='$id' UNION ALL
                            SELECT g.userID, d.level+1
                            FROM downline d, greatsavings g WHERE g.sponsorID=d.userID
                        )
                        SELECT COUNT(userID)as multiplier FROM downline WHERE level=5");

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
        foreach($levelFiveCount as $count5)
        {
            $levelFiveMultiplier = $count5->multiplier;
        }
        $totalStars = ($levelTwoMultiplier*6) + ($levelThreeMultiplier*6) + ($levelFourMultiplier*12) + ($levelFiveMultiplier*18);

        return $totalStars;
    }

    public static function getEncashment($id)
    {
        return DB::table('greatsavedata')
                    ->select('encashment')
                    ->where('id', $id)
                    ->get();
    }

    public static function getRebateBalance($id)
    {
        return DB::table('greatsavedata')
                    ->select('rebateBalance')
                    ->where('id', $id)
                    ->get();
    }

    public static function getStars($id)
    {
        return DB::table('greatsavedata')
                    ->select('stars')
                    ->where('id', $id)
                    ->get();
    }

    public static function getSponsorID($id)
    {
        return DB::table('users')
                    ->select('sponsorID')
                    ->where('id', $id)
                    ->get();
    }

    public static function updateGreatSave($id, $rebate, $stars, $encashment, $rebateBalance)
    {
        return DB::table('greatsavedata')
                    ->where('id', $id)
                    ->limit(1)
                    ->update(array('rebate' => $rebate,
                                    'stars' => $stars,
                                    'encashment' => $encashment,
                                    'rebateBalance' => $rebateBalance
                            ));
    }

    public static function newGreatSaveUser($data)
    {
        $userID = $data['userID'];
        $sponsorID = $data['sponsorID'];
        $fullName = $data['fullName'];
        DB::insert("INSERT into greatsavings (userID, sponsorID, fullName)
                    values (?,?,?)",
                    [
                        $userID, $sponsorID, $fullName
                    ]);
    }
}
