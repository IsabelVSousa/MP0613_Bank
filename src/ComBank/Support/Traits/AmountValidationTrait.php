<?php

namespace ComBank\Support\Traits;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 2:35 PM
 */

use ComBank\Exceptions\ZeroAmountException;

trait AmountValidationTrait
{
    /**
     * @param float $amount
     * @throws ZeroAmountException
     */
    public function validateAmount(float $amount): void
    {
        if ($amount <= 0) {
            throw new ZeroAmountException('Amount must be greater than zero.');
        }
    }

    public function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            throw new ZeroAmountException($emailErr);
        }
    }
}
