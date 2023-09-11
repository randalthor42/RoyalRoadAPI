<?php

namespace App\Services\User;

use App\Services\User\UserServiceInterface;
use App\Parsers\ParserRegistry;
use App\DTOs\UserDto;

class UserService implements UserServiceInterface
{
    /** @var ParserRegistry */
    protected $parserRegistry;


    /**
     * UserService constructor.
     *
     * @param ParserRegistry $parserRegistry
     */
    public function __construct(ParserRegistry $parserRegistry)
    {
        $this->parserRegistry = $parserRegistry;

    }

     /**
     * Get Author details by author ID.
     * 
     * @param string $authorId
     * @return UserDto
     */
    public function getAuthorById($authorId): UserDto
    {
        $authorParser = $this->parserRegistry->getParser('author');
        $details = $authorParser->parse($authorId);
        return new UserDto(
            $details['username'], 
            $details['joinedDate'],
        );
    }

}
