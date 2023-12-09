<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index(){

       $user = Auth::id();
       $FindUser=User::find($user);
       $userType = $FindUser->userType;
       if ($userType== 0){

           return view('User.User');
       }else{

           return view('Admin.Dashboard');
       }
   }
}
