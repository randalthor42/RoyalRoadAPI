<?php

namespace App\Services\User;

interface UserServiceInterface
{
    public function getUserById($id);
    public function getAuthor($novelId);
}
