<?php namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 1:22 PM
 */

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class WithdrawTransaction implements BankTransactionInterface
{
 private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function applyTransaction(BankAccountInterface $bankAccount): float
    {
        return $bankAccount->getBalance() - $this->amount;
    }

    public function getTransactionInfo(): string
    {
        // cambiar aquí el valor
        return 'Transaction info';
    }
    public function getAmount(): float
    {
        // cambiar aquí el valor
        return $this->amount;
    }
   
}
