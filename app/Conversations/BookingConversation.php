<?php

namespace App\Conversations;

use App\bug as database;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class BookingConversation extends Conversation
{
    public function savedefect()
    {
        $user = $this->bot->userStorage()->find();
		$db = new database ();
		$db->product = $user->get('product');
		$db->name = $user->get('name');
		$db->device = $user->get('device');
		$db->phone = $user->get('phone');
		$db->description = $user->get('description');
		$db->severity = $user->get('severity');
		$db->reproduce = $user->get('reproduce');
		$db-> save ();
 
		$this->askService();
	
}

 public function askService()
    {
        $question = Question::create('Great! I have logged the defect for you. Thank you for your participation. Do you want to log another defect?')
            ->fallback('select something')
            ->callbackId('askService')
            ->addButtons([
                Button::create('Yes')->value('yes'),
				Button::create('No')->value('no'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ('no' === $answer->getValue()) {
                    $joke = json_decode(file_get_contents('http://api.icndb.com/jokes/random'));
                    $this->say('Ok. I have a joke for you!');
					$this->say($joke->value->joke);
					return true;
                } else {
			$this->bot->userStorage()->save([
                'yes' => $answer->getText(),
            ]);
			$this->bot->startConversation(new SelectServiceConversation());
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
        $this->savedefect();
    }
}
