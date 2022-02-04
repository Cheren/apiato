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

namespace App\Containers\AppSection\User\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Hash;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;

/**
 * Class CreateUserByCredentialsTask
 *
 * @package App\Containers\AppSection\User\Tasks
 */
class CreateUserByCredentialsTask extends Task
{
    /**
     * Hold repository.
     *
     * @var UserRepository
     */
    protected UserRepository $repository;

    /**
     * CreateUserByCredentialsTask constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run action.
     *
     * @param   bool $isAdmin
     * @param   string $email
     * @param   string $password
     * @param   string|null $name
     * @param   string|null $gender
     * @param   string|null $birth
     *
     * @return  User
     *
     * @throws  CreateResourceFailedException
     */
    public function run(
        bool $isAdmin,
        string $email,
        string $password,
        string $name = null,
        string $gender = null,
        string $birth = null
    ): User {
        try {
            // create new user
            $user = $this->repository->create([
                'password' => Hash::make($password),
                'email' => $email,
                'name' => $name,
                'gender' => $gender,
                'birth' => $birth,
                'is_admin' => $isAdmin,
            ]);
        } catch (Exception $e) {
            throw new CreateResourceFailedException();
        }

        return $user;
    }
}
