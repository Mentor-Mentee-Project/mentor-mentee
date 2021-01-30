<?php

declare(strict_types=1);

namespace App\Repositories\User;

interface IUserRepository
{
    public function getUserBySub($sub);

    public function getUserById($id);

    public function getMentors();
}
