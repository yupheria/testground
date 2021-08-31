<?php

namespace App\Controller;

use App\Entity\Tester;
use App\Service\MySampleService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function home(LoggerInterface $logger, MySampleService $mySampleService) {

        $logger->info("Home Index page loaded");

        $myID = $mySampleService->getMyService();

        $rows = $this->getDoctrine()
            ->getRepository(Tester::class)
            ->findAll();

        $params = [
            "headerText" => "Hi There",
            "myID" => $myID,
            "mahList" => $rows
        ];
        return $this->render("index.html.twig", $params);
    }
}