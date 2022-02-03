<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use Illuminate\Http\JsonResponse;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;
use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\AppSection\User\Actions\DeleteUserAction;
use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Containers\AppSection\User\Actions\GetAllUsersAction;
use App\Containers\AppSection\User\Actions\GetAllAdminsAction;
use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\Actions\RegisterUserAction;
use App\Containers\AppSection\User\Actions\GetAllClientsAction;
use App\Containers\AppSection\User\Actions\ResetPasswordAction;
use App\Containers\AppSection\User\Actions\ForgotPasswordAction;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\AppSection\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\AppSection\User\Actions\GetAuthenticatedUserAction;
use App\Containers\AppSection\User\UI\API\Requests\CreateAdminRequest;
use App\Containers\AppSection\User\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\AppSection\User\UI\API\Requests\ResetPasswordRequest;
use App\Containers\AppSection\User\UI\API\Requests\ForgotPasswordRequest;
use App\Containers\AppSection\User\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserPrivateProfileTransformer;

/**
 * Class Controller
 *
 * @package App\Containers\AppSection\User\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * Action register user.
     *
     * @param   RegisterUserRequest $request
     *
     * @return  array
     *
     * @throws  InvalidTransformerException
     * @throws  CreateResourceFailedException
     */
    public function registerUser(RegisterUserRequest $request): array
    {
        $user = app(RegisterUserAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    /**
     * Action create admin.
     *
     * @param   CreateAdminRequest $request
     *
     * @return  array
     *
     * @throws  InvalidTransformerException
     * @throws  CreateResourceFailedException
     */
    public function createAdmin(CreateAdminRequest $request): array
    {
        $admin = app(CreateAdminAction::class)->run($request);
        return $this->transform($admin, UserTransformer::class);
    }

    /**
     * Action update user.
     *
     * @param   UpdateUserRequest $request
     *
     * @return  array
     *
     * @throws  NotFoundException
     * @throws  InternalErrorException
     * @throws  InvalidTransformerException
     * @throws  UpdateResourceFailedException
     */
    public function updateUser(UpdateUserRequest $request): array
    {
        $user = app(UpdateUserAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    /**
     * Action delete user.
     *
     * @param   DeleteUserRequest $request
     *
     * @return  JsonResponse
     *
     * @throws  NotFoundException
     * @throws  DeleteResourceFailedException
     */
    public function deleteUser(DeleteUserRequest $request): JsonResponse
    {
        app(DeleteUserAction::class)->run($request);
        return $this->noContent();
    }

    /**
     * Action get all users.
     *
     * @param   GetAllUsersRequest $request
     *
     * @return  array
     *
     * @throws  RepositoryException
     * @throws  CoreInternalErrorException
     * @throws  InvalidTransformerException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getAllUsers(GetAllUsersRequest $request): array
    {
        $users = app(GetAllUsersAction::class)->run();
        return $this->transform($users, UserTransformer::class);
    }

    /**
     * Action get all clients.
     *
     * @param   GetAllUsersRequest $request
     *
     * @return  array
     *
     * @throws  RepositoryException
     * @throws  CoreInternalErrorException
     * @throws  InvalidTransformerException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getAllClients(GetAllUsersRequest $request): array
    {
        $users = app(GetAllClientsAction::class)->run();
        return $this->transform($users, UserTransformer::class);
    }

    /**
     * Action get all admins.
     *
     * @param   GetAllUsersRequest $request
     *
     * @return  array
     *
     * @throws  RepositoryException
     * @throws  CoreInternalErrorException
     * @throws  InvalidTransformerException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getAllAdmins(GetAllUsersRequest $request): array
    {
        $users = app(GetAllAdminsAction::class)->run();
        return $this->transform($users, UserTransformer::class);
    }

    /**
     * action find user by id.
     *
     * @param   FindUserByIdRequest $request
     *
     * @return  array
     *
     * @throws  NotFoundException
     * @throws  InvalidTransformerException
     */
    public function findUserById(FindUserByIdRequest $request): array
    {
        $user = app(FindUserByIdAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    /**
     * Action get authenticated user.
     *
     * @param   GetAuthenticatedUserRequest $request
     *
     * @return  array
     *
     * @throws  NotFoundException
     * @throws  InvalidTransformerException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request): array
    {
        $user = app(GetAuthenticatedUserAction::class)->run();
        return $this->transform($user, UserPrivateProfileTransformer::class);
    }

    /**
     * Action reset password.
     *
     * @param   ResetPasswordRequest $request
     *
     * @return  JsonResponse
     *
     * @throws  InternalErrorException
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        app(ResetPasswordAction::class)->run($request);
        return $this->noContent(204);
    }

    /**
     * Action forgot password.
     *
     * @param   ForgotPasswordRequest $request
     *
     * @return  JsonResponse
     *
     * @throws  NotFoundException
     * @throws  InternalErrorException
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        app(ForgotPasswordAction::class)->run($request);
        return $this->noContent(202);
    }
}
