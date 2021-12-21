<?php

namespace App\Service;

use App\Models\User;

class BaseService
{
    public function getUserLogin()
    {
        $user = User::where('id', auth()->user()->id)->first();
        
        return $user;
    }
}