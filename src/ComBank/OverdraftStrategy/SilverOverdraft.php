<?php
namespace ComBank\OverdraftStrategy;

use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use Override;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 1:39 PM
 */

/**
 * @description: Grant 100.00 overdraft funds.
 * */
class SilverOverdraft implements OverdraftInterface
{
    public function isGrantOverdraftFunds(float $newAmount): bool
    {
        return ($this->getOverdraftFundsAmount() + $newAmount) >= 0;
    }

    public function getOverdraftFundsAmount(): float
    {
        return 100.0;
    }

    public function getInterestRate(): float
    {
        return 0.05;
    }
}
