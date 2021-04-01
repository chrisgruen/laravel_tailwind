<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    public $customerTypes = array('private','company');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','role','zipcode','address','city','company','phonenumber','mobilenumber','customerType',
        'parentID','isSub','firstname','lastname','authKeyMail','authKeyPost','registrationState',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getGuardUser() {
        $user_quard = Auth::user();
        $user_table = $user_quard->getTable();

        if($user_table == 'accounts') {
            $user = Account::find(Auth::id());
        } else {
            $user = User::find(Auth::id());
        }

        return $user;
    }
}
