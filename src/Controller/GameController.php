<?php

namespace App\Controller;

use App\Form\GameFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     * @return Response
     */
    public function index(): Response
    {
        $gameForm = $this->createForm(GameFormType::class, null);
        return $this->render('game/index.html.twig', [
            'controller_name' => 'RuleController',
            'form' => $gameForm->createView()
        ]);
    }
}
