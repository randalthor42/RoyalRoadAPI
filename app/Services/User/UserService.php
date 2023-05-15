<?php

namespace App\Services\User;

use App\Services\User\UserServiceInterface;
use App\Transformers\UserTransformer;
use simplehtmldom\HtmlWeb;

class UserService implements UserServiceInterface
{
    /** @var HtmlWeb */
    protected $htmlWeb;

    /** @var UserTransformer */
    protected $userTransformer;

    public function __construct(HtmlWeb $htmlWeb, UserTransformer $userTransformer)
    {
        $this->htmlWeb = $htmlWeb;
        $this->userTransformer = $userTransformer;
    }

    public function getUserById($id)
    {
        return $id;
    }

    public function getAuthor($novelId)
    {
        $author = '';
        return $author;
    }
}
