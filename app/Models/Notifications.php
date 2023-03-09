<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StartupSavings;
use App\Models\GreatSavings;
use DB;

class Notifications extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable =
    [
        'id',
        'title',
        'message',
        'status',
    ];

    public static function getAll()
    {
        return DB::table('notifications')->get();
    }

    public static function read($id)
    {
        return DB::table('notifications')
                    ->where('id', $id)
                    ->limit(1)
                    ->update(array('status' => 1));
    }

    public static function unread($id)
    {
        return DB::table('notifications')
                    ->where('id', $id)
                    ->limit(1)
                    ->update(array('status' => 0));
    }

    public static function countUnread()
    {
        return DB::table('notifications')->where('status', 0)->count();
    }

    public static function startupLevelNotify($id)
    {
        $userInfo = DB::table('startupsavings')->where('userID', $id)->first();
        $userName = $userInfo->fullName;
        $countLevelOne = StartupSavings::levelCount($id, 1);
        $countLevelTwo = StartupSavings::levelCount($id, 2);
        $countLevelThree = StartupSavings::levelCount($id, 3);
        $countLevelFour = StartupSavings::levelCount($id, 4);

        if($countLevelTwo === 2)
        {
            $message = $userName." "."has completed Startup Savings Level 2";
            $checkNotif = DB::table('notifications')->where('message', $message)->first();
            if($checkNotif === null)
            {
                Notifications::create(array(
                    "title" => 'Start-up Level 2 Completed',
                    "message" => $message,
                    "status" => 0
                ));
            }
        }

        if($countLevelThree === 2)
        {
            $message = $userName." "."has completed Startup Savings Level 3";
            $checkNotif = DB::table('notifications')->where('message', $message)->first();
            if($checkNotif === null)
            {
                Notifications::create(array(
                    "title" => 'Start-up Level 3 Completed',
                    "message" => $message,
                    "status" => 0
                ));
            }
        }

        if($countLevelFour === 4096)
        {
            $message = $userName." "."has completed Startup Savings Level 4";
            $checkNotif = DB::table('notifications')->where('message', $message)->first();
            if($checkNotif === null)
            {
                Notifications::create(array(
                    "title" => 'Start-up Level 4 Completed',
                    "message" => $message,
                    "status" => 0
                ));
            }
        }
    }

    public static function greatLevelNotify($id)
    {
        $userInfo = DB::table('greatsavings')->where('userID', $id)->first();
        $userName = $userInfo->fullName;
        $countLevelOne = GreatSavings::levelCount($id, 1);
        $countLevelTwo = GreatSavings::levelCount($id, 2);
        $countLevelThree = GreatSavings::levelCount($id, 3);
        $countLevelFour = GreatSavings::levelCount($id, 4);
        $countLevelFive = GreatSavings::levelCount($id, 5);
        // if($countLevelOne === 8)
        // {
        //     $message = $userName." "."has completed GreatSavings Level 1";
        //     $checkNotif = DB::table('notifications')->where('message', $message)->first();
        //     if($checkNotif === null)
        //     {
        //         Notifications::create(array(
        //             "title" => 'Great Level 1 Completed',
        //             "message" => $message,
        //             "status" => 0
        //         ));
        //     }
        // }

        // if($countLevelTwo === 64)
        // {
        //     $message = $userName." "."has completed GreatSavings Level 2";
        //     $checkNotif = DB::table('notifications')->where('message', $message)->first();
        //     if($checkNotif === null)
        //     {
        //         Notifications::create(array(
        //             "title" => 'Great Level 2 Completed',
        //             "message" => $message,
        //             "status" => 0
        //         ));
        //     }
        // }

        // if($countLevelThree === 512)
        // {
        //     $message = $userName." "."has completed GreatSavings Level 3";
        //     $checkNotif = DB::table('notifications')->where('message', $message)->first();
        //     if($checkNotif === null)
        //     {
        //         Notifications::create(array(
        //             "title" => 'Great Level 3 Completed',
        //             "message" => $message,
        //             "status" => 0
        //         ));
        //     }
        // }

        // if($countLevelFour === 4096)
        // {
        //     $message = $userName." "."has completed GreatSavings Level 4";
        //     $checkNotif = DB::table('notifications')->where('message', $message)->first();
        //     if($checkNotif === null)
        //     {
        //         Notifications::create(array(
        //             "title" => 'Great Level 4 Completed',
        //             "message" => $message,
        //             "status" => 0
        //         ));
        //     }
        // }

        if($countLevelFive === 32768)
        {
            $message = $userName." "."has completed GreatSavings Level 5";
            $checkNotif = DB::table('notifications')->where('message', $message)->first();
            if($checkNotif === null)
            {
                Notifications::create(array(
                    "title" => 'Great Level 5 Completed',
                    "message" => $message,
                    "status" => 0
                ));
            }
        }
    }
}
