<?php
declare(strict_types = 1);

namespace App\Project\Application\Responses;

use IceHawk\IceHawk\Constants\HttpCode;

/**
 * Class InternalServerError
 *
 * @package App\Project\Application\Responses
 */
final class InternalServerError
{
    public function respond()
    {
        header('Content-Type: text/html; charset=utf-8', true, HttpCode::INTERNAL_SERVER_ERROR);
        echo "500 - Internal Server Error";
        flush();
    }
}
