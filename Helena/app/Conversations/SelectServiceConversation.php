<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class SelectServiceConversation extends Conversation
{
    public function askService()
    {
        $question = Question::create('Please select the product you have a defect for')
            ->fallback('select something')
            ->callbackId('askService')
            ->addButtons([
                Button::create('MySafaricom App')->value('MySafaricomApp'),
				Button::create('MPesa App')->value('MpesaApp'),
				Button::create('Other')->value('Other'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ('joke' === $answer->getValue()) {
                    $joke = json_decode(file_get_contents('http://api.icndb.com/jokes/random'));
                    $this->say($joke->value->joke);
                } else {
			$this->bot->userStorage()->save([
                'product' => $answer->getText(),
            ]);
			$this->say('You selected: '.$answer->getText());
			$this->bot->startConversation(new LoggingConversation());
				}
            }
			
        });
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askService();
    }
}
