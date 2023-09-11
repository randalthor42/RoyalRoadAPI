<?php
namespace App\DTOs;

use DateTime;
use JsonSerializable;

class UserDto implements JsonSerializable
{
    private $username;
    private $joinedDate;


    public function __construct(
        string $username, 
        DateTime $joinedDate,
    )
    {
        $this->username = $username;
        $this->joinedDate = $joinedDate;
     
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getJoinedDate(): DateTime
    {
        return $this->joinedDate;
    }
}
