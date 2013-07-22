<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Contact\Core\Usecase\Message;
use Contact\Core\Usecase\Message\Send\Interactor;
use Contact\Core\Usecase\Message\Send\Message;
use Contact\Core\Usecase\Message\Send\Sender;

class Send
{
    private $data;
    private $tools;

    public function __construct(array $data, array $tools)
    {
        $this->data = $data;
        $this->tools = $tools;
    }

    public function fetch()
    {
        return new Interactor(
            $this->get_message(),
            $this->get_sender()
        );
    }

    private function get_message()
    {
        return new Message(
            $this->data['message'],
            $this->tools['emailer'],
            $this->tools['formatter'],
            $this->tools['validator']
        );
    }

    private function get_sender()
    {
        return new Sender(
            $this->data['person'],
            $this->tools['validator']
        );
    }
}
