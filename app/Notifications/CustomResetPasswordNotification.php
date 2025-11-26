<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;

class CustomResetPasswordNotification extends ResetPassword {

    public function toMail($notifiable) {
        $url = url('password.reset', $this->token, 'email' => $notifiable->getEmailForPasswordReset());


    }

}
