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
use PhpParser\Node\Expr\Cast\Double;
use PhpParser\Node\Stmt\TryCatch;
use PHPUnit\Event\Test\FailedSubscriber;

class BankAccount
{
    private float $balance;
    private bool $status;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
        $this->status = false;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
    public function reopenAccount(): void
    {
        if($this->status){
            throw new BankAccountException('The account its already open');
        }

        $this->status = true;
        echo 'Opening bank account';
    }
    public function closeAccount(): void
    {
        if(!$this->status){
            throw new BankAccountException('The account its already closed');
        }

        $this->status = false;
        echo 'Closing bank account';
    }

    public function transaction(BrankTransactionInterface $bankAccount): void{

    }
}
