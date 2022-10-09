<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class LoggingConversation extends Conversation
{

public function askDescription()
    {
		
        $this->ask('Please describe the defect for me?', function (Answer $answer) {
            $this->bot->userStorage()->save([
                'description' => $answer->getText(),
            ]);

            $this->say('Got it');
            $this->askSeverity();
        });
    }


public function askSeverity()
    {
        $question = Question::create('How severe would you say the bug is?')
            ->fallback('select something')
            ->callbackId('askService')
            ->addButtons([
                Button::create('Critical')->value('Critical'),
				Button::create('Major')->value('Major'),
				Button::create('Moderate')->value('Moderate'),
                Button::create('Minor')->value('Minor'),
				Button::create('Cosmetic')->value('Cosmetic'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
					$this->bot->userStorage()->save([
                'severity' => $answer->getText(),
            ]);
			$this->say($answer->getText().' it is.');
			$this->askSteps();
            }
			
        });
    }


    public function askSteps()
    {
        $this->ask('How can it be reproduced?', function (Answer $answer) {
            $this->bot->userStorage()->save([
                'reproduce' => $answer->getText(),
            ]);

            $this->bot->startConversation(new BookingConversation());
        });
    }

       
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askDescription();
    }
}
