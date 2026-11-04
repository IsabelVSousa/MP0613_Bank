<?php

namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 11:30 AM
 */

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class InterestTransaction extends BaseTransaction implements BankTransactionInterface
{

    public function __construct(float $amount = 0.0)
    {
        // $this->validateAmount($amount);
        $this->amount = $amount;
    }

    public function applyTransaction(BankAccountInterface $bankAccount): float
    {
        return $bankAccount->getBalance() + ($bankAccount->getBalance()*$bankAccount->getOverdraft()->getInterestRate());
    }

    public function getTransactionInfo(): string
    {
        return 'INTEREST_TRANSACTION';
    }

}
