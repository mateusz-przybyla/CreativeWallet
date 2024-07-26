<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class DateLimitRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    $today = date('Y-m-d');

    return $data[$field] <= $today && $data[$field] > '2000-01-01';
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return "Select a date between today and 2000-01-01.";
  }
}
