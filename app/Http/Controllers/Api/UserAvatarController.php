<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAvatarController extends Controller
{

    
    public function store(){

    $this->validate(request(),[
        'avatar' => ['required','image']
    ]);
    }
}
