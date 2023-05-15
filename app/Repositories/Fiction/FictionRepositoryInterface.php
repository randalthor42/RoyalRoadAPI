<?php

namespace App\Repositories\Fiction;

interface FictionRepositoryInterface
{
    public function getFiction($id, $includes = []);
}
