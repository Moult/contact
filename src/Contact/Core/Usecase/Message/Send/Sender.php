<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Contact\Core\Usecase\Message\Send;
use Contact\Core\Data;
use Contact\Core\Tool;
use Contact\Core\Exception;

class Sender extends Data\Person
{
    public $name;
    public $email;
    private $validator;

    public function __construct(Data\Person $person, Tool\Validator $validator)
    {
        $this->name = $person->name;
        $this->email = $person->email;
        $this->validator = $validator;
    }

    public function validate()
    {
        $this->validator->setup(array(
            'name' => $this->name,
            'email' => $this->email
        ));
        $this->validator->rule('name', 'not_empty');
        $this->validator->rule('email', 'not_empty');
        $this->validator->rule('email', 'email');
        $this->validator->rule('email', 'email_domain');
        if ( ! $this->validator->check())
            throw new Exception\Validation($this->validator->errors());
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_email()
    {
        return $this->email;
    }
}
