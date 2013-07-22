<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Contact\Core\Usecase\Message\Send;

class Interactor
{
    private $message;
    private $sender;

    public function __construct(Message $message, Sender $sender)
    {
        $this->message = $message;
        $this->sender = $sender;
    }

    public function interact()
    {

        $this->sender->validate();
        $this->message->validate();
        $this->message->send_from(
            $this->sender->get_name(),
            $this->sender->get_email()
        );
    }
}
