<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Business\Writer;

use Generated\Shared\Transfer\CustomerApproveProcessItemTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;
use Generated\Shared\Transfer\StateMachineProcessTransfer;
use Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessEntityManagerInterface;
use Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessRepositoryInterface;
use Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface;

class CustomerApproveProcessItemWriter implements CustomerApproveProcessItemWriterInterface
{
    /**
     * @var \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface
     */
    protected $stateMachineFacade;

    /**
     * @var \Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessRepositoryInterface
     */
    protected $repository;

    /**
     * @var \Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface $stateMachineFacade
     * @param \Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessRepositoryInterface $repository
     * @param \Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessEntityManagerInterface $entityManager
     */
    public function __construct(
        StateMachineFacadeInterface $stateMachineFacade,
        CustomerApproveProcessRepositoryInterface $repository,
        CustomerApproveProcessEntityManagerInterface $entityManager
    ) {
        $this->stateMachineFacade = $stateMachineFacade;
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer
     */
    public function createCustomerApproveProcessItem(CustomerTransfer $customerTransfer): CustomerApproveProcessItemTransfer
    {
        $customerApproveProcessItemTransfer = (new CustomerApproveProcessItemTransfer())
            ->setIdCustomer($customerTransfer->getIdCustomer());

        $this->entityManager->saveCustomerApproveProcessItemEntity($customerApproveProcessItemTransfer);

        $stateMachineProcessTransfer = (new StateMachineProcessTransfer())
            ->setStateMachineName('CustomerApproveProcess')
            ->setProcessName('Process01');

        $this->stateMachineFacade
            ->triggerForNewStateMachineItem(
                $stateMachineProcessTransfer,
                $customerApproveProcessItemTransfer->getIdCustomerApproveProcessItem()
            );

        return $this->repository
            ->findCustomerApproveProcessItemById(
                $customerApproveProcessItemTransfer->getIdCustomerApproveProcessItem()
            );
    }

    /**
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer
     */
    public function updateCustomerApproveProcessItem(StateMachineItemTransfer $stateMachineItemTransfer): CustomerApproveProcessItemTransfer
    {
        $customerApproveProcessItemTransfer = $this->repository
            ->findCustomerApproveProcessItemById($stateMachineItemTransfer->getIdentifier());

        $customerApproveProcessItemTransfer->setStateMachineItem($stateMachineItemTransfer);

        return $this->entityManager->saveCustomerApproveProcessItemEntity($customerApproveProcessItemTransfer);
    }
}
