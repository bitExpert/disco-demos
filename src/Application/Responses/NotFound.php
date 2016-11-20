<?php
declare(strict_types = 1);

namespace App\Project\Application\Responses;

use IceHawk\IceHawk\Constants\HttpCode;

/**
 * Class NotFound
 *
 * @package App\Project\Application\Responses
 */
final class NotFound
{
    public function respond()
    {
        header('Content-Type: text/plain; charset=utf-8', true, HttpCode::NOT_FOUND);
        echo "404 - Not found";
        flush();
    }
}
