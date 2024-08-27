<?php

declare(strict_types=1);

namespace Src\Profile\Domain\Exception;

use Src\Shader\Domain\Exception\BaseException;

class ProfileNotFoundException extends BaseException
{
    public function __construct()
    {
        parent::__construct("Profile not found.", 404);
    }
}