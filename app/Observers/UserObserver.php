<?php

namespace App\Observers;

use App\Mail\VerifyEmailUser;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
   public function created(User $user)
   {
      Mail::to($user->username)->send(new VerifyEmailUser($user));
   }
}
