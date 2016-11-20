<?php
declare(strict_types = 1);

namespace App\Project\Application\Endpoints\Start\Read;

use App\Project\Application\Responses\Page;
use IceHawk\IceHawk\Interfaces\HandlesGetRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;

/**
 * Class SayHelloRequestHandler
 *
 * @package App\Project\Application\Endpoints\Start\Read
 */
final class SayHelloRequestHandler implements HandlesGetRequest
{
    public function handle(ProvidesReadRequestData $request)
    {
        # This method handles a GET (and HEAD) request

        # And responds with a 200 OK and page content

        (new Page())->respond(file_get_contents(__DIR__ . '/Pages/hello.html'));
    }
}
