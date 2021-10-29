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
     * Get the game return
     */
    public function index(Request $request): Response
    {
        // rule of the game  3 = Foo - 5 = Bar - 7 = Qix
        $rules = ['Foo', 'Bar', 'Qix'];
        $gameReturn = "";
        $error = "";
        $gameForm = $this->createForm(GameFormType::class, null);

        $gameForm->handleRequest($request);
        // If we receive digits
        if ($gameForm->isSubmitted() && $gameForm->isValid()) {
            $data = $gameForm->getData();
            $numbers = $data['input'];
            //check if divide by 3,5,7 is true
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
            //check all digits
            foreach ($digits as $digit){
                switch($digit){
                    case '0':
                        $gameReturn .= '*';
                    break;
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
            $gameReturn = $gameReturn == "" || $gameReturn == "*" ? str_replace('0', '*', $numbers) : $gameReturn;
        } else {
            $error = "Please enter only digits";
        }

        return $this->render('game/index.html.twig', [
            'form' => $gameForm->createView(),
            'gameReturn' => $gameReturn,
            'error' => $error
        ]);
    }
}
