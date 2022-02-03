<?php

namespace App\Containers\AppSection\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Notifications\Notification;

/**
 * Class UserRegisteredNotification
 *
 * @package App\Containers\AppSection\User\Notifications
 */
class UserRegisteredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Hold user.
     *
     * @var User
     */
    protected User $user;

    /**
     * UserRegisteredNotification constructor
     * .
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * To array action.
     *
     * @param   $notifiable
     *
     * @return  array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function toArray($notifiable): array
    {
        return [
            // ... do you own customization
        ];
    }
}
