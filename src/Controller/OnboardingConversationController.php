<?php

namespace App\Controller;

use BotMan\BotMan\Messages\Incoming\Answer;
use Symfony\Component\Console\Question\Question;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotManApp\Controller\OnboardingConversation;



class OnboardingConversationController extends Conversation
{
    protected $firstname;

    protected $email;

    public function askFirstname()
    {
        $this->ask('salut! quel est votre prenom?', function(Answer $answer) {
            // Sauvegarde la reponse
            $this->firstname = $answer->getText();

            $this->say('Ravi de vous rencontrer '.$this->firstname);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('Une dernière chose - quelle est votre adresse e-mail?', function(Answer $answer) {
            // Sauvegarde la reponse
            $this->email = $answer->getText();

            $this->say('Génial - c est tout ce dont nous avons besoin, '.$this->firstname);
        });
    }
    public function askMood()
    {
        $this->ask('Comment vas-tu?', function (Answer $response) {
            $this->say('Cool - vous avez dit ' . $response->getText());
        });
    }
    public function run()
    {
        $question = Question::create('quel type de produit recherchez vous?')
        ->addButtons([
            Button::create('je recherche des produit cosmetiques')->value('cosmetique'),
            Button::create('je recherche des produit pharmacologiques')->value('pharmacie'),
        ]);
        $this->ask($question, function ($answer){
            if ($answer->isInteractiveMessageReply()) {
                $this->say('votre selection:' .$answer->getValue());
            }
        });
        // rappel la reponse
        $this->askFirstname();
    }
}
 