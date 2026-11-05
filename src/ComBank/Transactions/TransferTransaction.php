<?php

namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 1:22 PM
 */

use ComBank\Bank\BankAccount;
use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class TransferTransaction extends BaseTransaction implements BankTransactionInterface
{

    private BankAccount $destinationAccount;

    public function __construct(float $amount, BankAccountInterface $destinationAccount)
    {
        parent::__construct($amount);
        $this->destinationAccount = $destinationAccount;
    }

    public function applyTransaction(BankAccountInterface $bankAccount): float
    {
        $newBalance = $bankAccount->getBalance() - $this->amount;

        if (!$bankAccount->getOverdraft()->isGrantOverdraftFunds($newBalance)) {
            throw new InvalidOverdraftFundsException('Your withdraw have reached the max overdraft funds.');
        }

        //deposit al destinatario
        
        $this->destinationAccount->setBalance($this->destinationAccount->getBalance() + $this->amount);
        // $this->destinationAccount->getBalance() + $this->amount;
        // $this->setDestinationAccount();

        return $newBalance;
        //setearlo fuera
    }

    public function getTransactionInfo(): string
    {
        // cambiar aquí el valor
        return 'TRANSFER_TRANSACTION';
    }
    public function getAmount(): float
    {
        // cambiar aquí el valor
        return $this->amount;
    }

    public function setDestinationAccount(BankAccountInterface $destination)
    {
        $this->destinationAccount = $destination;
    }

    public function getDestinationAccount() : BankAccountInterface{
        return $this->destinationAccount;
    }
}
