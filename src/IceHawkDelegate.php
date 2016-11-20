<?php
declare(strict_types = 1);

namespace App\Project;

use IceHawk\IceHawk\Interfaces\ProvidesRequestInfo;
use IceHawk\IceHawk\Interfaces\SetsUpEnvironment;

/**
 * Class IceHawkDelegate
 *
 * @package App\Project
 */
final class IceHawkDelegate implements SetsUpEnvironment
{
    public function setUpGlobalVars()
    {
        # You can change your global vars like $_SERVER, $_GET, $_POST, etc. here, before IceHawk will use them
    }

    public function setUpErrorHandling(ProvidesRequestInfo $requestInfo)
    {
        # PHP's default error handling is used unless you set up something else here.
    }

    public function setUpSessionHandling(ProvidesRequestInfo $requestInfo)
    {
        # PHP's default session handling is used unless you set up something else here.
    }
}
