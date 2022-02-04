<?php

/**
 * Beauty application system
 *
 * This file is part of the Beauty application system package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    Proprietary
 * @copyright  Copyright (C) kalistratov.ru, All rights reserved.
 * @link       https://kalistratov.ru
 */

namespace App\Containers\AppSection\User\Mails;

use Illuminate\Bus\Queueable;
use App\Ship\Parents\Mails\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Containers\AppSection\User\Models\User;

/**
 * Class UserRegisteredMail
 *
 * @package App\Containers\AppSection\User\Mails
 */
class UserRegisteredMail extends Mail implements ShouldQueue
{
    use Queueable;

    /**
     * Hold user.
     *
     * @var User
     */
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build action.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->view('appSection@user::user-registered')
            ->to($this->user->email, $this->user->name)
            ->with([
                'name' => $this->user->name,
            ]);
    }
}
