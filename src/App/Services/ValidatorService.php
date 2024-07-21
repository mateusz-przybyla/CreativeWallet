<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
  RequiredRule,
  EmailRule,
  MatchRule
};

class ValidatorService
{
  private Validator $validator;

  public function __construct()
  {
    $this->validator = new Validator();

    $this->validator->addRule('required', new RequiredRule());
    //$this->validator->addRule('lengthMax', new LengthMaxRule());
    //$this->validator->addRule('email', new EmailRule());
    //$this->validator->addRule('match', new MatchRule());
  }

  public function validateRegister(array $formData)
  {
    $this->validator->validate($formData, [
      'username' => ['required'],
      'email' => ['required'/*, 'email'*/],
      'password' => ['required'],
      'passwordConfirmed' => ['required'/*, 'match:password'*/]
    ]);
  }
}
