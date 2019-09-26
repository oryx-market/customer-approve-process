<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Business\Writer;

use Generated\Shared\Transfer\CustomerApproveProcessItemTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;

interface CustomerApproveProcessItemWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer
     */
    public function createCustomerApproveProcessItem(CustomerTransfer $customerTransfer): CustomerApproveProcessItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer
     */
    public function updateCustomerApproveProcessItem(StateMachineItemTransfer $stateMachineItemTransfer): CustomerApproveProcessItemTransfer;
}
