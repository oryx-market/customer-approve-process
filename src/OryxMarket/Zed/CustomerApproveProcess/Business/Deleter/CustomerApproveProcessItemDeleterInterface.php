<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Business\Deleter;

use Generated\Shared\Transfer\StateMachineItemTransfer;

interface CustomerApproveProcessItemDeleterInterface
{
    /**
     * @param int $customerApproveProcessItemId
     *
     * @return void
     */
    public function deleteCustomerApproveProcessItem(int $customerApproveProcessItemId): void;
}
