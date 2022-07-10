<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        // return 'Hello World!';
        return view('login');
    }

    public function check() {
        
        $session = session();
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('password');

        $userModel = new \App\Models\UserModel();
        $user_details = $userModel->where('email', $email)->first();

        if($user_details){
            $password = $user_details['password'];

            if($pass === $password){
                $ses_data = [
                    'user_id'       => $user_details['id'],
                    'user_name'     => $user_details['name'],
                    'user_email'    => $user_details['email'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/home');
            }
            else {
                echo 'Password not matched';
            }
        }

    }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/');

    }
}