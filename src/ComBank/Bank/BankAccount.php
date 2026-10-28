<?php

namespace ComBank\Bank;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:25 PM
 */
 
use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\OverdraftStrategy\NoOverdraft;
use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Support\Traits\AmountValidationTrait;
use ComBank\Transactions\Contracts\BankTransactionInterface;


class BankAccount implements BankAccountInterface 
{
    private float $balance;
    private bool $status;

    private OverdraftInterface $overdraft;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
        $this->status = true;
        $this->overdraft = new NoOverdraft();
    }

    public function getOverdraft(): OverdraftInterface
    {
        return $this->overdraft;
    }
    public function getBalance(): float
    {
        return $this->balance;
    }
    public function setBalance(float $newBalance): void
    {
        $this->balance = $newBalance;
    }
    public function reopenAccount(): void
    {
        if ($this->status) {
            throw new BankAccountException('The account its already open');
        }

        $this->status = true;
    }
    public function closeAccount(): void
    {
        if (!$this->status) {
            throw new BankAccountException('The account its already closed');
        }

        $this->status = false;
    }

    public function isOpen(): bool
    {
        return $this->status;
    }

    public function transaction(BankTransactionInterface $bankTransaction): void
    {
       
        if (!$this->isOpen()) {
            throw new BankAccountException('The account is closed.');
        }


        $newBalance = $bankTransaction->applyTransaction($this);  
        $this->setBalance($newBalance);
    }

    public function applyOverdraft(OverdraftInterface $overdraft): void
    {
        $this->overdraft = $overdraft;
    }
}
