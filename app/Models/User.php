<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userName',
        'activationCode',
        'firstName',
        'middleName',
        'lastName',
        'date_of_birth',
        'contactInfo',
        'email',
        'password',
        'IsUpgraded',
        'role',
        'cycle',
    ];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function DirectReferral($id)
    {
        $ref_list = DB::select("WITH RECURSIVE downline AS(
                        SELECT id, firstName, middleName, lastName, activationCode, email, 0 as level
                        FROM users where id='$id' UNION ALL
                        SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, u.email, d.level+1
                        FROM downline d, users u WHERE u.sponsorID=d.id
                    )
                    SELECT * FROM downline WHERE level=1 ");
        return $ref_list;
    }

    public static function LevelOne($id)
    {
        $ref_list = DB::select("WITH RECURSIVE downline AS(
                        SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                        FROM users where id='$id' UNION ALL
                        SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
                        FROM downline d, users u WHERE u.sponsorID=d.id
                    )
                    SELECT COUNT(id)as multiplier FROM downline WHERE level=1 ");
        return $ref_list;
    }

    public static function LevelTwo($id)
    {
        $ref_list = DB::select("WITH RECURSIVE downline AS(
                        SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                        FROM users where id='$id' UNION ALL
                        SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
                        FROM downline d, users u WHERE u.sponsorID=d.id
                    )
                    SELECT COUNT(id) as multiplier FROM downline WHERE level=2 ");
        return $ref_list;
    }

    public static function LevelThree($id)
    {
        $ref_list = DB::select("WITH RECURSIVE downline AS(
                        SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                        FROM users where id='$id' UNION ALL
                        SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
                        FROM downline d, users u WHERE u.sponsorID=d.id
                    )
                    SELECT COUNT(id) as multiplier FROM downline WHERE level=3 ");
        return $ref_list;

    }

    public static function LevelFour($id)
    {
        $ref_list = DB::select("WITH RECURSIVE downline AS(
                        SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                        FROM users where id='$id' UNION ALL
                        SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
                        FROM downline d, users u WHERE u.sponsorID=d.id
                    )
                    SELECT COUNT(id) as multiplier FROM downline WHERE level=4 ");
        return $ref_list;
    }

    public static function newUserID($activationCode)
    {
        return DB::table('users')
                    ->select('id')
                    ->where('activationCode', $activationCode)
                    ->get();
    }

    public static function updateInfo($data, $id)
    {
        return DB::table('users')
                    ->where('id', $id)
                    ->limit(1)
                    ->update(array($data));
    }


}
