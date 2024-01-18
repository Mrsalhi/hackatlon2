<?php

namespace App\Controller;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BotManController extends AbstractController{

    function messageAction(Request $request): Response
    {
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

        // Configuration du BotMan WebDriver
        $config = [];

        // Créer une instance BotMan
        $botman = BotManFactory::create($config);

        // Donnez au bot des éléments à écouter.
        $botman->hears('(salut||hello)', function (BotMan $bot) {
            $bot->reply('salut!||hello');
        });

        // Définir une solution secondaire
        $botman->fallback(function (BotMan $bot) {
            $bot->reply('Désolée, je n ai pas compris.||Sorry, I did not understand');
        });

        // Commencer à écouter/écrire
        $botman->listen();

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
