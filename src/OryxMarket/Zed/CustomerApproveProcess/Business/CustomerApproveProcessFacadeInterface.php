<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Business;

use Generated\Shared\Transfer\CustomerApproveProcessItemTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;

interface CustomerApproveProcessFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer[]
     */
    public function getAllCustomerApproveProcessItems(): array;

    /**
     * @param int[] $stateIds
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer[]
     */
    public function getCustomerApproveProcessItemsByStateIds(array $stateIds = []): array;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer
     */
    public function createCustomerApproveProcessStateMachineItem(CustomerTransfer $customerTransfer): CustomerApproveProcessItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer
     */
    public function updateCustomerApproveProcessStateMachineItem(StateMachineItemTransfer $stateMachineItemTransfer): CustomerApproveProcessItemTransfer;

    /**
     * @param int $customerApproveProcessItemId
     *
     * @return void
     */
    public function deleteCustomerApproveProcessStateMachineItem(int $customerApproveProcessItemId): void;
}
