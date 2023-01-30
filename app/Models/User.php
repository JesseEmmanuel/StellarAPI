<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
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
        'sponsorID',
        'activationCode',
        'firstName',
        'middleName',
        'lastName',
        'date_of_birth',
        'contactInfo',
        'email',
        'password',
        'role',
    ];

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

    public function DirectReferral($id)
    {
        $ref_list = DB::select("WITH RECURSIVE downline AS(
                        SELECT id, firstName, middleName, lastName, activationCode, 0 as level
                        FROM users where id='$id' UNION ALL
                        SELECT u.id, u.firstName, u.middleName, u.lastName, u.activationCode, d.level+1
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
        $newUser = TABLE::select('id')->where('activationCode', $activationCode)->first();
        return $newUser;
    }
}
