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
  LengthMaxRule,
  NumericRule,
  DateFormatRule,
  DateLimitRule,
  UniqueRule
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
    $this->validator->addRule('numeric', new NumericRule());
    $this->validator->addRule('dateFormat', new DateFormatRule());
    $this->validator->addRule('dateLimit', new DateLimitRule());
    $this->validator->addRule('unique', new UniqueRule());
  }

  public function validateRegister(array $formData)
  {
    $this->validator->validate($formData, [
      'username' => ['required', 'alphanumeric', 'lengthMin:3', 'lengthMax:20'],
      'email' => ['required', 'email'],
      'password' => ['required', 'lengthMin:6'],
      'passwordConfirmed' => ['required', 'lengthMin:6', 'match:password']
    ]);
  }

  public function validateLogin(array $formData)
  {
    $this->validator->validate($formData, [
      'email' => ['required', 'email'],
      'password' => ['required', 'lengthMin:6']
    ]);
  }

  public function validateIncomeTransaction(array $formData)
  {
    $this->validator->validate($formData, [
      'amount' => ['required', 'numeric'],
      'date' => ['required', 'dateFormat:Y-m-d', 'dateLimit'],
      'category' => ['required'],
      'comment' => ['lengthMax:255']
    ]);
  }

  public function validateExpenseTransaction(array $formData)
  {
    $this->validator->validate($formData, [
      'amount' => ['required', 'numeric'],
      'date' => ['required', 'dateFormat:Y-m-d', 'dateLimit'],
      'category' => ['required'],
      'paymentMethod' => ['required'],
      'comment' => ['lengthMax:255']
    ]);
  }

  public function validateTimePeriod(array $formData)
  {
    $this->validator->validate($formData, [
      'startDate' => ['dateFormat:Y-m-d'],
      'endDate' => ['dateFormat:Y-m-d']
    ]);
  }

  public function validateEditIncomeCategory(int $id, array $formData)
  {
    $this->validator->validate($formData, [
      'editIncomeCategory' => ['required']
    ], $id);
  }

  public function validateEditExpenseCategory(int $id, array $formData)
  {
    $this->validator->validate($formData, [
      'editExpenseCategory' => ['required']
    ], $id);
  }

  public function validateEditPaymentMethod(int $id, array $formData)
  {
    $this->validator->validate($formData, [
      'editPaymentMethod' => ['required'],
    ], $id);
  }

  public function validateNewIncomeCategory(array $formData)
  {
    $this->validator->validate($formData, [
      'newIncomeCategory' => ['required']
    ]);
  }

  public function validateNewExpenseCategory(array $formData)
  {
    $this->validator->validate($formData, [
      'newExpenseCategory' => ['required']
    ]);
  }

  public function validateNewPaymentMethod(array $formData)
  {
    $this->validator->validate($formData, [
      'newPaymentMethod' => ['required']
    ]);
  }

  public function validateNewPassword(array $formData)
  {
    $this->validator->validate($formData, [
      'oldPassword' => ['required'],
      'newPassword' => ['required'],
      'newPasswordConfirmed' => ['required', 'match:newPassword', 'unique:oldPassword']
    ]);
  }
}
