<?php

namespace App\Repositories\User;

use App\Services\User\UserServiceInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $userService;
   
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;    
    }

    public function getAuthorById($userId)
    {
        return $this->userService->getAuthorById($userId);
    }


}
