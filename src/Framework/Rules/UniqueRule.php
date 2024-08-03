<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class UniqueRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    $fieldOne = $data[$field];
    $fieldTwo = $data[$params[0]];

    if (strlen($fieldOne) > 0 && strlen($fieldTwo) > 0) {
      return $fieldOne !== $fieldTwo;
    } else {
      return true;
    }
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return "Your new password cannot be same as old password.";
  }
}
