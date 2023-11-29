<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //

    public function store(){
        $user = new User();
        $user->name = "kwh";
        $user->email = "kwh@gmail.com";
        $user->password = Hash::make("123456");
        $user->save();

        $phone = new Phone();
        $phone->phone = "09877665678";
        $user->phone()->save($phone);
        return "User Created Successfully";
    }
}
