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
        $this->validator->add_required_rule('name');
        $this->validator->add_required_rule('email');
        $this->validator->add_email_rule('email');
        $this->validator->add_email_domain_rule('email');
        if ( ! $this->validator->is_valid())
            throw new Exception\Validation($this->validator->get_error_keys());
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
