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

namespace App\Containers\AppSection\User\Events;

use App\Ship\Parents\Events\Event;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Containers\AppSection\User\Models\User;

/**
 * Class UserRegisteredEvent
 *
 * @package App\Containers\AppSection\User\Events
 */
class UserRegisteredEvent extends Event implements ShouldQueue
{
    /**
     * Hold user.
     *
     * @var User
     */
    protected User $user;

    /**
     * UserRegisteredEvent constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the Event. (Single Listener Implementation)
     */
    public function handle(): void
    {
        $userHashKey = $this->user->getHashedKey();
        Log::info('New User registration. ID = ' . $userHashKey . ' | Email = ' . $this->user->email . '.');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
