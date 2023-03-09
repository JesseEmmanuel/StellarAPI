<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\StartupSavings;
use App\Models\GreatSavings;
use DB;

class Rewards extends Model
{
    use HasFactory;
    protected $table = 'user_rewards';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'userID',
        'rewardsID',
        'redeemStatus'
    ];

    public static function checkStartupRewards($id)
    {
        $userInfo = DB::table('users')->where('id', $id)->first();
        $countLevelTwo = StartupSavings::levelCount($id, 2);
        $countLevelThree = StartupSavings::levelCount($id, 3);
        $countLevelFour = StartupSavings::levelCount($id, 4);

        if($countLevelTwo === 64)
        {
            $checkRewards = DB::table('user_rewards')->where('userID', $id)->where('rewardsID', 1)->first();
            if($checkRewards === null)
            {
                Rewards::create(array(
                    "userID" => $id,
                    "rewardsID" => 1,
                    "redeemStatus" => 0
                ));
            }
        }

        if($countLevelThree === 512)
        {
            $checkRewards = DB::table('user_rewards')->where('userID', $id)->where('rewardsID', 2)->first();
            if($checkRewards === null)
            {
                Rewards::create(array(
                    "userID" => $id,
                    "rewardsID" => 2,
                    "redeemStatus" => 0
                ));
            }
        }

        if($countLevelFour === 4096)
        {
            $checkRewards = DB::table('user_rewards')->where('userID', $id)->where('rewardsID', 3)->first();
            if($checkRewards === null)
            {
                Rewards::create(array(
                    "userID" => $id,
                    "rewardsID" => 3,
                    "redeemStatus" => 0
                ));
            }
        }


    }

    public static function checkGreatSavingsRewards($id)
    {
        $userInfo = DB::table('greatsavings')->where('userID', $id)->first();
        $countLevelOne = GreatSavings::levelCount($id, 1);
        $countLevelTwo = GreatSavings::levelCount($id, 2);
        $countLevelThree = GreatSavings::levelCount($id, 3);
        $countLevelFour = GreatSavings::levelCount($id, 4);
        $countLevelFive = GreatSavings::levelCount($id, 5);
        $totalCount = $countLevelOne + $countLevelTwo + $countLevelThree + $countLevelFour + $countLevelFive;

        if($totalCount >= 850)
        {
            $checkRewards = DB::table('user_rewards')->where('userID', $id)->where('rewardsID', 4)->first();
            if($checkRewards === null)
            {
                Rewards::create(array(
                    "userID" => $id,
                    "rewardsID" => 4,
                    "redeemStatus" => 0
                ));
            }
        }

        if($countLevelFive === 32768)
        {
            $checkRewards = DB::table('user_rewards')->where('userID', $id)->where('rewardsID', 5)->first();
            if($checkRewards === null)
            {
                Rewards::create(array(
                    "userID" => $id,
                    "rewardsID" => 5,
                    "redeemStatus" => 0
                ));
            }
        }
    }

    public static function getRewards($id)
    {
        return DB::select("SELECT user_rewards.userID, user_rewards.rewardsID, user_rewards.redeemStatus, rewards.rewardsItem, rewards.rewardsImage, user_rewards.created_at
                            FROM rewards INNER JOIN user_rewards ON rewards.rewardsID = user_rewards.rewardsID
                            WHERE (((user_rewards.userID)='$id') AND ((user_rewards.redeemStatus)=0))");
    }
}
