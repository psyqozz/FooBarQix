<?php

namespace App\Controller;

use App\Form\GameFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     * @return Response
     */
    public function index(Request $request): Response
    {
        $rules = ['Foo', 'Bar', 'Qix'];
        $gameReturn = "";
        $gameForm = $this->createForm(GameFormType::class, null);

        $gameForm->handleRequest($request);
        if ($gameForm->isSubmitted() && $gameForm->isValid()) {
            $data = $gameForm->getData();
            $numbers = $data['input'];
            $gameReturn = $numbers;
            if($numbers % 3 == 0){
                $gameReturn = $rules[0];
            }
            if($numbers % 5 == 0) {
                $gameReturn .= $rules[1];
            }
            if($numbers % 7 == 0) {
                $gameReturn .= $rules[2];
            }
            $digits = str_split($data['input'], 1);
            foreach ($digits as $digit){
                switch($digit){
                    case '3':
                        $gameReturn .= $rules[0];
                    break;
                    case '5':
                        $gameReturn .= $rules[1];
                    break;
                    case '7':
                        $gameReturn .= $rules[2];
                    break;
                }
            }
        }

        return $this->render('game/index.html.twig', [
            'controller_name' => 'RuleController',
            'form' => $gameForm->createView(),
            'gameReturn' => $gameReturn
        ]);
    }
}
