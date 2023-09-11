<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /** @var UserRepositoryInterface */
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show(Request $request, $website, $userId)
    {    
        $user = $this->userRepository->getAuthorById($userId);
        return response()->json($user);
    }


}
