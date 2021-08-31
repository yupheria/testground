<?php


namespace App\Service;


use Psr\Log\LoggerInterface;

class MySampleService
{
    private $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function getMyService() {
        $myID = uniqid();
        return $myID;
    }
}