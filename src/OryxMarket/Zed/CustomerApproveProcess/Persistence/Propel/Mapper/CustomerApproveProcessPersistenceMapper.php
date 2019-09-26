<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CustomerApproveProcessItemTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;
use Orm\Zed\CustomerApproveProcess\Persistence\PyzCustomerApproveProcessItem;

class CustomerApproveProcessPersistenceMapper
{
    /**
     * @param \Orm\Zed\CustomerApproveProcess\Persistence\PyzCustomerApproveProcessItem $customerApproveProcessItemEntity
     * @param \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer $customerApproveProcessItemTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer
     */
    public function mapEntityToCustomerApproveProcessItemTransfer(
        PyzCustomerApproveProcessItem $customerApproveProcessItemEntity,
        CustomerApproveProcessItemTransfer $customerApproveProcessItemTransfer
    ): CustomerApproveProcessItemTransfer {
        $customerEntity = $customerApproveProcessItemEntity->getSpyCustomer();
        $stateMachineProcessEntity = $customerApproveProcessItemEntity->getSpyStateMachineProcess();
        $stateMachineItemStateEntity = $customerApproveProcessItemEntity->getSpyStateMachineItemState();

        $stateMachineItemTransfer = (new StateMachineItemTransfer())
            ->setIdentifier($customerApproveProcessItemEntity->getIdCustomerApproveProcessItem());

        if ($stateMachineProcessEntity !== null) {
            $stateMachineItemTransfer
                ->setIdStateMachineProcess($stateMachineProcessEntity->getIdStateMachineProcess())
                ->setProcessName($stateMachineProcessEntity->getName())
                ->setStateMachineName($stateMachineProcessEntity->getStateMachineName());
        }

        if ($stateMachineItemStateEntity !== null) {
            $stateMachineItemTransfer
                ->setIdItemState($stateMachineItemStateEntity->getIdStateMachineItemState())
                ->setStateName($stateMachineItemStateEntity->getName());
        }

        $customerApproveProcessItemTransfer
            ->setIdCustomerApproveProcessItem($customerApproveProcessItemEntity->getIdCustomerApproveProcessItem())
            ->setIdCustomer($customerEntity->getIdCustomer())
            ->setCustomerName($customerEntity->getFirstName() . ' ' . $customerEntity->getFirstName())
            ->setCustomerEmail($customerEntity->getEmail())
            ->setStateMachineItem($stateMachineItemTransfer);

        return $customerApproveProcessItemTransfer;
    }
}
