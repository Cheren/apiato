<?php

namespace App\Containers\AppSection\User\UI\CLI\Commands;

use App\Ship\Parents\Commands\ConsoleCommand;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Containers\AppSection\User\UI\API\Requests\CreateAdminRequest;

/**
 * Class CreateAdminCommand
 *
 * @package App\Containers\AppSection\User\UI\CLI\Commands
 */
class CreateAdminCommand extends ConsoleCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apiato:create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new User with the ADMIN role';

    /**
     * Handle action.
     *
     * @throws  CreateResourceFailedException
     */
    public function handle(): void
    {
        $username = $this->ask('Enter the username for this user');
        $email = $this->ask('Enter the email address of this user');
        $password = $this->secret('Enter the password for this user');
        $password_confirmation = $this->secret('Please confirm the password');

        if ($password !== $password_confirmation) {
            $this->error('Passwords do not match - exiting!');
            return;
        }

        $request = new CreateAdminRequest([
            'name' => $username,
            'email' => $email,
            'password' => $password,
        ]);

        app(CreateAdminAction::class)->run($request);

        $this->info('Admin ' . $email . ' was successfully created');
    }
}
