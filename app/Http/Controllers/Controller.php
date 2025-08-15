<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Role;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function role()
    {
        $owner = Role::create([
            'name' => 'admin',
            'display_name' => 'ادمین', // optional
        ]);

        $admin = Role::create([
            'name' => 'user',
            'display_name' => 'کاربر عادی', // optional
        ]);
        return 'ok';
    }
}
