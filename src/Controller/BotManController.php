<?php

namespace App\Controller;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\Drivers\Web\WebDriver;
use BotMan\BotMan\Drivers\DriverManager;
use App\Controller\OnboardingConversation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use BotMan\BotMan\Messages\Conversations\Conversation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BotManController extends AbstractController{

    function messageAction(Request $request): Response
    {
        DriverManager::loadDriver(WebDriver::class);
        $config = [
            'web' => [
                'matchingData' => [
                    'driver' => 'web',
                ],
            ]
        ];
        // Créer une instance BotMan
        $botman = BotManFactory::create($config);
        
        // Donnez au bot des éléments à écouter.
        $botman->hears('(salut)', function (BotMan $bot) {
      #      $bot->startConversation(new OnboardingConversation);
            $bot->reply('salut!');
            $bot->ask('Quel est ton nom?', function($answer, $bot) {
                $bot->say('bienvenue '.$answer->getText());
            }); 
        });

        // Définir une solution secondaire
        $botman->fallback(function (BotMan $bot) {
            $bot->reply('Désolée, je n ai pas compris.');
        });

        // Commencer à écouter/écrire
    /*    $botman->listen();
        $botman = BotManFactory::create($config);
       
        $conversation=new OnBoardingConversation;
        $conversation->setBot($botman);
        $conversation->startConversation($conversation);
    
    $data=$conversation->getDataFromChatBot();
    return $this->render('chat.html.twig', ["data"=>$data]);
  
}*/
        return new Response();
    }
   
   #[Route('/', name:'home')]
   
    public function indexAction(Request $request): Response
    {
        return $this->render('home.html.twig');
    }
    

    #[Route('/chat', name:'chat')]
   
    public function chatAction(Request $request): Response
    {
        return $this->render('chat.html.twig');
    }
}
