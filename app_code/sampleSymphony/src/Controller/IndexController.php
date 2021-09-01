<?php

namespace App\Controller;

use App\Entity\Tester;
use App\Service\MySampleService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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

        $customResult = $this->getDoctrine()
            ->getRepository(Tester::class)
            ->fetchRowByID(2);

        $fromCustomQuery = $this->getDoctrine()
            ->getRepository(Tester::class)
            ->customQuery(3);

        $params = [
            "headerText" => "Hi There",
            "myID" => $myID,
            "mahList" => $rows,
            "customResult" => $customResult,
            "fromCustom" => $fromCustomQuery
        ];
        return $this->render("index.html.twig", $params);
    }

    /**
     * @Route("/testpage")
     */
    public function testpage() {
        return $this->render("base.html.twig");
    }

    /**
     * @Route("/parserpage")
     */
    public function parserpage() {
        $request = Request::createFromGlobals();
        $id = $request->query->get("id");

        $params = [
            "idGet" => $id
        ];

        return new JsonResponse($params);
    }
}