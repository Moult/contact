<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Contact\Core\Usecase\Message\Send;
use Contact\Core\Data;
use Contact\Core\Tool;
use Contact\Core\Exception;

class Message extends Data\Message
{
    public $text;
    private $emailer;
    private $formatter;
    private $validator;

    public function __construct(Data\Message $message, Tool\Emailer $emailer, Tool\Formatter $formatter, Tool\Validator $validator)
    {
        $this->text = $message->text;
        $this->emailer = $emailer;
        $this->formatter = $formatter;
        $this->validator = $validator;
    }

    public function validate()
    {
        $this->validator->setup(array('text' => $this->text));
        $this->validator->add_required_rule('text');
        if ( ! $this->validator->is_valid())
            throw new Exception\Validation($this->validator->get_error_keys());
    }

    public function send_from($sender_name, $sender_email)
    {
        $this->formatter->setup(array(
            'message_text' => $this->text,
            'sender_name' => $sender_name,
            'sender_email' => $sender_email
        ));
        $this->emailer->set_subject($this->formatter->format('Email_Message_Send_Subject'));
        $this->emailer->set_body($this->formatter->format('Email_Message_Send_Body'));
        $this->emailer->send();
    }
}
