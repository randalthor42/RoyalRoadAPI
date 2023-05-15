<?php

namespace App\Services\Fiction;

interface FictionServiceInterface
{
    public function getFiction($id, $includes = []);
}
