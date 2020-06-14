<?php

namespace App\Conversations;

use Validator;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class OnboardingConversation extends Conversation
{

    public function askName()
    {
		
        $this->ask('Hello Tester, What is your name?', function (Answer $answer) {
            $this->bot->userStorage()->save([
                'name' => $answer->getText(),
            ]);

            $this->say('Nice to meet you '.$answer->getText());
            $this->askdevice();
        });
    }

    public function askdevice()
    {
        $this->ask('What is your device make, version and operating system?', function (Answer $answer) {

            $this->bot->userStorage()->save([
                'device' => $answer->getText(),
            ]);

            $this->askPhone();
        });
    }

    public function askPhone()
    {
        $this->ask('What is your phone number?', function (Answer $answer) {
               $validator = Validator::make(['phone' => $answer->getText()], ['phone' => 'regex:/(0)[0-9]{9}/']);
			   
            if ($validator->fails()) {
                return $this->repeat('That doesn\'t look like a valid phone number. Please enter a valid number.');
            }
			
			$this->bot->userStorage()->save(['phone' => $answer->getText(),]);
										
             $this->bot->startConversation(new SelectServiceConversation());
        });
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askName();
    }
}
