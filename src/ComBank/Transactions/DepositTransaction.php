<?php namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 11:30 AM
 */

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class DepositTransaction 
{

    public function applyTransaction(BankAccountInterface $bankAccount) :float {
        $bankAccount->
        $bankAccount->getAmount() +150.00;
    
        // cambiar aquí el valor     
        return $this->ancho * $this->alto;
    }
    
    public function getTransaction() :string{
        // cambiar aquí el valor
        return 2 * ($this->ancho + $this->alto);
    }
    public function getAmount() :float{
        // cambiar aquí el valor
        return 2 * ($this->ancho + $this->alto);
    }
   
}
