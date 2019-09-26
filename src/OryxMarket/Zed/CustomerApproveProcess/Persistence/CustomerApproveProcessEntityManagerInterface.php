<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Persistence;

use Generated\Shared\Transfer\CustomerApproveProcessItemTransfer;

interface CustomerApproveProcessEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer $customerApproveProcessItemTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer
     */
    public function saveCustomerApproveProcessItemEntity(
        CustomerApproveProcessItemTransfer $customerApproveProcessItemTransfer
    ): CustomerApproveProcessItemTransfer;

    /**
     * @param int $idCustomerApproveProcessItem
     *
     * @return void
     */
    public function deleteCustomerApproveProcessItemEntity(int $idCustomerApproveProcessItem): void;
}
