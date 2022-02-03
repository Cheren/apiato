<?php

namespace App\Containers\AppSection\User\Mails;

use Illuminate\Bus\Queueable;
use App\Ship\Parents\Mails\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Containers\AppSection\User\Models\User;

/**
 * Class UserForgotPasswordMail
 *
 * @package App\Containers\AppSection\User\Mails
 */
class UserForgotPasswordMail extends Mail implements ShouldQueue
{
    use Queueable;

    /**
     * Hold user.
     *
     * @var User
     */
    protected User $recipient;

    /**
     * Hold user token.
     *
     * @var string
     */
    protected string $token;

    /**
     * Hold reset url.
     *
     * @var string
     */
    protected string $reseturl;

    /**
     * UserForgotPasswordMail constructor.
     *
     * @param   User $recipient
     * @param   $token
     * @param   $reseturl
     */
    public function __construct(User $recipient, $token, $reseturl)
    {
        $this->recipient = $recipient;
        $this->token = $token;
        $this->reseturl = $reseturl;
    }

    /**
     * Build action.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->view('appSection@user::user-forgotPassword')
            ->to($this->recipient->email, $this->recipient->name)
            ->with([
                'token' => $this->token,
                'reseturl' => $this->reseturl,
                'email' => $this->recipient->email,
            ]);
    }
}
