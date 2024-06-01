<?php

namespace App\Services\User;

use App\Enums\Users\RoleEnum;
use App\Models\Users\User;
use App\Repositories\Role\IRoleRepositoryInterface;
use Illuminate\Http\Response;
use PHPUnit\Event\Code\Throwable;

class RoleService
{
    public function __construct(
        protected IRoleRepositoryInterface $repository
    ) {}

    public function addRole(User $user, RoleEnum $role)
    {
        $roleRecord = $this->getRole($role);

        if(is_null($roleRecord)) {
            throw new \Exception(
                message: 'Given role does not exists',
                code: Response::HTTP_BAD_REQUEST
            );
        }

        return $this->repository->add($user, $roleRecord);
    }

    public function removeRole(User $user, RoleEnum $role)
    {
        $roleRecord = $this->getRole($role);

        if(is_null($roleRecord)) {
            throw new \Exception(
                message: 'Given role does not exists',
                code: Response::HTTP_BAD_REQUEST
            );
        }

        return $this->repository->remove($user, $roleRecord);
    }

    private function getRole(RoleEnum $role)
    {
        return $this->repository->find($role);
    }
}
