<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $UsersModel = new \App\Models\UsersModel();
        $loggedUserId = session()->get('loggedUser');
        $userinfo = $UsersModel->find($loggedUserId);
        $data = [
            'title' => 'dashboard',
            'userinfo' => $userinfo
        ];
        
        return view('dashboard/index',$data);
    }

    function profile()
    {
        $UsersModel = new \App\Models\UsersModel();
        $loggedUserId = session()->get('loggedUser');
        $userinfo = $UsersModel->find($loggedUserId);
        $data = [
            'title' => 'profile',
            'userinfo' => $userinfo
        ];
        return view('dashboard/profile',$data);
    }


}
