<?php
declare(strict_types = 1);

namespace App\Project;

use bitExpert\Disco\BeanFactory;
use IceHawk\IceHawk\Interfaces\ConfiguresIceHawk;
use IceHawk\IceHawk\Interfaces\ProvidesRequestInfo;
use IceHawk\IceHawk\Interfaces\RespondsFinallyToReadRequest;
use IceHawk\IceHawk\Interfaces\RespondsFinallyToWriteRequest;

/**
 * Class IceHawkDiscoConfigDelegate
 *
 * @package App\Project
 */
final class IceHawkDiscoConfigDelegate implements ConfiguresIceHawk
{
    protected $beanFactory;

    /**
     * Creates a new {@link \App\Project\IceHawkDiscoConfigDelegate}.
     *
     * @param BeanFactory $beanFactory
     */
    public function __construct(BeanFactory $beanFactory)
    {
        $this->beanFactory = $beanFactory;
    }

    public function getRequestInfo() : ProvidesRequestInfo
    {
        return $this->beanFactory->get('requestInfo');
    }

    public function getReadRoutes() : array
    {
        return $this->beanFactory->get('readRoutes');
    }

    public function getWriteRoutes() : array
    {
        return $this->beanFactory->get('writeRoutes');
    }

    public function getEventSubscribers() : array
    {
        return $this->beanFactory->get('eventSubscribers');
    }

    public function getFinalReadResponder() : RespondsFinallyToReadRequest
    {
        return $this->beanFactory->get('finalReadResponder');
    }

    public function getFinalWriteResponder() : RespondsFinallyToWriteRequest
    {
        return $this->beanFactory->get('finalWriteResponder');
    }
}
