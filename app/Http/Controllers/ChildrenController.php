<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    protected $userService;
    

    public function __construct(UserService $userService){
        $this->userService = $userService;
        
    }
    //
    public function index($id)
    {      $users=$this->userService->getstudentbyparents($id);
        return  view('children',['users'=>$users] );
        /*foreach ($users as $user){
            return $user[0]->role;

        }
        return $users;*/
       // return $users;
    }
}
