<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Hash;

class Auth extends BaseController
{

    public function __construct(){
        helper(['url','form']);
    }

    public function index()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function save()
    {
        $validation = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Your full name is required'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'You must enter a valid email',
                    'is_unique' => 'Email already exit'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[12]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'password must have atleast 5 characters in length',
                    'max_length' => 'password must not have characters more than 12  in length'
                ]
            ],
            'cpassword' => [
                'rules' => 'required|min_length[5]|max_length[12]|matches[password]',
                'errors' => [
                    'required' => 'confirm password is required',
                    'min_length' => 'confirm password must have atleast 5 characters in length',
                    'max_length' => 'confirm password must not have characters more than 12  in length',
                    'matches' => 'confirm password not matches to password'
                ]
            ]

        ]);


        if(!$validation){
            return view('auth/register',['validation'=>$this->validator]);
        }else{
            //echo "fully register successfully";
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $values = [
                'name' =>$name,
                'email' =>$email,
                'password' =>Hash::make($password),
            ];

            $UsersModel = new \App\Models\UsersModel();
            $query = $UsersModel->insert($values);

            if(!$query){
                return redirect()->back()->with('fail','something went wrong' );
            }else{
                //return redirect()->to('auth/register')->with('success','successfully register fully' );
                $last_id = $UsersModel->insertID();
                session()->set('loggedUser',$last_id);
                return redirect()->to('/dashboard');
            }
        }
    }

    function check(){
        
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_not_unique[users.email]',
                'errors' => [
                    'required' => 'Enter your email id',
                    'valid_email' => 'Enter the valid email',
                    'is_not_unique' => 'email not exits'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[12]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'password must have atleast 5 characters in length',
                    'max_length' => 'password must not have characters more than 12  in length'
                ]
            ]
        ]);

        if(!$validation){
            return view('auth/login',['validation'=>$this->validator]);
        }else{
            //echo "form successfully validated";

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $UsersModel = new \App\Models\UsersModel();
            $user_info = $UsersModel->where('email',$email)->first();
            $check_password = Hash::check($password,$user_info['password']);

            if(!$check_password){
                session()->setFlashdata('fail','Incorrect password');
                return redirect()->to('auth')->withInput();
            }else{
                $user_id = $user_info['id'];
                session()->set('loggedUser',$user_id);
                return redirect()->to('/dashboard');
            }
        }
    }

    function logout(){
        if(session()->has('loggedUser')){
            session()->remove('loggedUser');
            return redirect()->to('/auth?access=out')->with('fail','Your logged out' );
        }
    }
    
}