<?php

namespace App\UserLib;


use Illuminate\Support\Facades\Auth;

class AuthCackle
{
    static public function login_cackle()
    {
        $user = Auth::user();
        $siteApiKey = "GlviY4JI5H4FKvdMnSh9cZA5DY9w3WqsjegfB1oqe6gsMkgPH1utYpSxwMzTIaaS";

      if ($user) {
          $user_ = [
              'id' => $user->id,
              'name' => $user->login,
              'avatar' => $user->avatar ? asset('public/storage/avatars/' . $user->id . '/' . $user->avatar) : asset('public/images/avatar.png')
          ];

          if ($user->email_verified_at!=NULL)
              $user_data = base64_encode(json_encode($user_));
          else     $user_data = base64_encode('{}');
      }
      else
          $user_data = base64_encode('{}');




        $timestamp = round(microtime(true) * 1000);
        $sign = md5($user_data . $siteApiKey . $timestamp);
        $mass['auth_cackle'] =  ['user_data'=> $user_data,'sign'=>$sign,'timestamp'=>$timestamp];
        session($mass);

    }

}
