<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Business\Reader;

use ArrayObject;
use Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessRepositoryInterface;
use Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface;

class CustomerApproveProcessItemReader implements CustomerApproveProcessItemReaderInterface
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
     * @param \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface $stateMachineFacade
     * @param \Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessRepositoryInterface $repository
     */
    public function __construct(
        StateMachineFacadeInterface $stateMachineFacade,
        CustomerApproveProcessRepositoryInterface $repository)
    {
        $this->stateMachineFacade = $stateMachineFacade;
        $this->repository = $repository;
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer[]
     */
    public function getAllStateMachineItems(): array
    {
        $customerApproveProcessItems = $this->repository->getAllCustomerApproveProcessItems();

        foreach ($customerApproveProcessItems as $customerApproveProcessItem) {
            $stateHistory = $this->stateMachineFacade
                ->getStateHistoryByStateItemIdentifier(
                    $customerApproveProcessItem->getStateMachineItem()->getIdStateMachineProcess(),
                    $customerApproveProcessItem->getIdCustomerApproveProcessItem()
                );

            $customerApproveProcessItem->setStateHistory(new ArrayObject($stateHistory));
        }

        return $customerApproveProcessItems;
    }

    /**
     * @param int[] $stateIds
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer[]
     */
    public function getStateMachineItemsByStateIds(array $stateIds = []): array
    {
        return $this->repository->getCustomerApproveProcessItemsByStateIds($stateIds);
    }
}
