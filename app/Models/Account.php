<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Account extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard = 'account';
    protected $guard_name = 'account';


    protected $fillable = [
        'company_id', 'email', 'password', 'firstname', 'lastname', 'phonenumber', 'faxnumber', 'mobilenumber', 'is24username', 'is24oauth_token', 'is24oauth_token_secret'
    ];

    public static $permissions = ['manage employees','manage company','manage suppliers','manage boilerplates','manage billing'];
    public static $admin_permissions = ['force confirm user', 'confirm user', 'assign company roles', 'impersonate user', 'manage news','manage companies',
                                         'manage systemsettings', 'manage bills', 'manage auctions'];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company() {
        return $this->belongsTo('App\Models\Company');
    }

    public static function publish_name($id) {
        $account = Account::where('id', $id)->first();
        return $account;
    }
}
