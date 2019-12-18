<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\User\User;
use Backpack\CRUD\app\Models\Traits\InheritsRelationsFromParentModel;
use Backpack\CRUD\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;

/**
 * Class BackpackUser.
 * phpcs:ignoreFile
 */
class BackpackUser extends User
{
    use InheritsRelationsFromParentModel;
    use Notifiable;

    /**
     * @var string $table The table associated with the model.
     */
    protected $table = 'users';

    /**
     * Send the password reset notification.
     *
     * @param string $token Token.
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
}
