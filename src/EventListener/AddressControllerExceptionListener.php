<?php

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class AddressControllerExceptionListener
{
    private $code = 500;
    private $message = "Internal Server Error";

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!$exception instanceof \Exception) {
            return;
        }
        
        $this->logger->err($exception->getMessage());
        $code = 500;

        $responseData = [
            'error' => [
                'code' => $this->code,
                'message' => $this->message
            ]
        ];

        $event->setResponse(new JsonResponse($responseData, $code));
    }
}