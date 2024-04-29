<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControllerJson extends AbstractController
{
    #[Route("/api")]
    public function api(): Response
    {
        $jsonRoutes = [
            '/api/quote' => 'Returns a random quote',
        ];

        return $this->render('api.html.twig', [
            'jsonRoutes' => $jsonRoutes,
        ]);
    }

    #[Route("/api/quote")]
    public function quote(): Response
    {
        date_default_timezone_set('Europe/Stockholm');

        $quotes = [
            "In the world there are a lot of fascinating things no living soul has ever seen! - Fujitaka",
            "You will have all the strength you will need inside. And you have a future only you can create. - Clow Reed",
            "If he can fly, I can fly! I can do anything he can! - Meiling",
            "No matter what you are thinking, if you do not say it, you would not be able to express it. - Tomoyo",
            "I do not know how I will feel when I am dead, but I do not want to regret the way I lived. - Yuji Itadori",
            "Are you the strongest because you are Gojo Satoru? Or are you Gojo Satoru because you are the strongest? - Geto Suguru"
        ];

        $randomIndex = floor(rand(0, count($quotes) - 1));
        $randomQuote = $quotes[$randomIndex];

        $responseQuote = [
            'Quote' => $randomQuote,
            'Date' => date('Y-m-d'),
            'Time' => date('H:i')
        ];
    
        $response = new JsonResponse($responseQuote);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
