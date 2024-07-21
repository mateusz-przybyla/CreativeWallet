<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class AlphanumericRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    return (bool) ctype_alnum($data[$field]);
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return "Choose between letters from a(A) to z(Z) and numbers from 0 to 9.";
  }
}
