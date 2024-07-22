<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
  RequiredRule,
  EmailRule,
  MatchRule,
  AlphanumericRule,
  LengthMinRule,
  LengthMaxRule
};

class ValidatorService
{
  private Validator $validator;

  public function __construct()
  {
    $this->validator = new Validator();

    $this->validator->addRule('required', new RequiredRule());
    $this->validator->addRule('email', new EmailRule());
    $this->validator->addRule('match', new MatchRule());
    $this->validator->addRule('alphanumeric', new AlphanumericRule());
    $this->validator->addRule('lengthMin', new LengthMinRule());
    $this->validator->addRule('lengthMax', new LengthMaxRule());
  }

  public function validateRegister(array $formData)
  {
    $this->validator->validate($formData, [
      'username' => ['required', 'alphanumeric', 'lengthMin:3', 'lengthMax:20'],
      'email' => ['required', 'email'],
      'password' => ['required'],
      'passwordConfirmed' => ['required', 'match:password']
    ]);
  }

  public function validateLogin(array $formData)
  {
    $this->validator->validate($formData, [
      'email' => ['required', 'email'],
      'password' => ['required']
    ]);
  }

  public function validateTransaction(array $formData)
  {
  }
}
