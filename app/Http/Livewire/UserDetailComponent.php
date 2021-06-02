<?php

namespace App\Http\Livewire;


use App\Student;
use App\StudentDBMoodle;
use App\Traits\FlashMessageLivewaire;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserDetailComponent extends Component
{
   use FlashMessageLivewaire;

   public $user, $change_password = false, $profile;

   public $password_current, $password, $password_confirmation;

   function mount(User $user)
   {
      $this->profile = Auth::id() == $user->id ?? false;
      $this->user = $user;
   }

   function render()
   {
      return view('livewire.user.details-component');
   }

   public function update()
   {
      $this->validate([
         'password_current'      => 'required',
         'password'              => 'required|min:6',
         'password_confirmation' => 'required_with:password|same:password|min:6'
      ]);
      if(Hash::check($this->password_current, Auth::user()->getAuthPassword())) {
         Auth::user()->setAttribute('password', Hash::make(trim($this->password)))->save();
         $this->showAlert('alert-success', __('messages.success.update'));
         $this->cancel();
         return;
      }
      $this->showAlert('alert-success', __('messages.error.update'));
   }

   private function cancel()
   {
      $this->password_current       = '';
      $this->password_confirmation  = '';
      $this->password               = '';
      $this->change_password        = false;
   }
}