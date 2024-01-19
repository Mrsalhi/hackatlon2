<?php
namespace App\Service;
use BotMan\BotMan\Messages\Conversations\Conversation;

class OnBoardingConversation extends Conversation
{
protected $firstname;

protected $email;

public function askFirstname()
{
    $this->ask('salut! quel est votre prenom?', function( $answer) {
        // Sauvegarde la reponse
        $this->firstname = $answer->getText();

        $this->say('Ravi de vous rencontrer '.$this->firstname);
    });
}

public function askEmail()
{
    $this->ask('Une dernière chose - quelle est votre adresse e-mail?', function($answer) {
        // Sauvegarde la reponse
        $this->email = $answer->getText();

        $this->say('Génial - c est tout ce dont nous avons besoin, '.$this->firstname);
    });
}
public function askMood()
{
    $this->ask('Comment vas-tu?', function ($response) {
        $this->say('Cool - vous avez dit ' . $response->getText());
    });
}
public function run()
{
  // rappel la reponse
    $this->askEmail();
    $this->askFirstname();
}
}
