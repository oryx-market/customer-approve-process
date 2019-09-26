<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Business;

use Generated\Shared\Transfer\CustomerApproveProcessItemTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\CustomerApproveProcess\Business\CustomerApproveProcessBusinessFactory getFactory()
 */
class CustomerApproveProcessFacade extends AbstractFacade implements CustomerApproveProcessFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer[]
     */
    public function getAllCustomerApproveProcessItems(): array
    {
        return $this->getFactory()
            ->createCustomerApproveProcessItemReader()
            ->getAllStateMachineItems();
    }

    /**
     * @param int[] $stateIds
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer[]
     */
    public function getCustomerApproveProcessItemsByStateIds(array $stateIds = []): array
    {
        return $this->getFactory()
            ->createCustomerApproveProcessItemReader()
            ->getStateMachineItemsByStateIds($stateIds);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer
     */
    public function createCustomerApproveProcessStateMachineItem(CustomerTransfer $customerTransfer): CustomerApproveProcessItemTransfer
    {
        return $this->getFactory()
            ->createCustomerApproveProcessItemWriter()
            ->createCustomerApproveProcessItem($customerTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer
     */
    public function updateCustomerApproveProcessStateMachineItem(StateMachineItemTransfer $stateMachineItemTransfer): CustomerApproveProcessItemTransfer
    {
        return $this->getFactory()
            ->createCustomerApproveProcessItemWriter()
            ->updateCustomerApproveProcessItem($stateMachineItemTransfer);
    }

    /**
     * @param int $customerApproveProcessItemId
     *
     * @return void
     */
    public function deleteCustomerApproveProcessStateMachineItem(int $customerApproveProcessItemId): void
    {
        $this->getFactory()
            ->createCustomerApproveProcessItemDeleter()
            ->deleteCustomerApproveProcessItem($customerApproveProcessItemId);
    }
}
