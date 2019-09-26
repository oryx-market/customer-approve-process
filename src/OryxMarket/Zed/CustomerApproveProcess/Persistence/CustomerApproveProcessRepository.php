<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Persistence;

use Generated\Shared\Transfer\CustomerApproveProcessItemTransfer;
use Orm\Zed\CustomerApproveProcess\Persistence\PyzCustomerApproveProcessItemQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Pyz\Zed\CustomerApproveProcess\Persistence\Propel\Mapper\CustomerApproveProcessPersistenceMapper;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessPersistenceFactory getFactory()
 */
class CustomerApproveProcessRepository extends AbstractRepository implements CustomerApproveProcessRepositoryInterface
{
    /**
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer[]
     */
    public function getAllCustomerApproveProcessItems(): array
    {
        $customerApproveProcessItemEntities = $this->getCustomerApproveProcessItemQuery()
            ->joinWithSpyStateMachineItemState(Criteria::LEFT_JOIN)
            ->joinWithSpyStateMachineProcess(Criteria::LEFT_JOIN)
            ->joinWithSpyCustomer()
            ->find();

        $customerApproveProcessItems = [];
        foreach ($customerApproveProcessItemEntities as $customerApproveProcessItemEntity) {
            $customerApproveProcessItems[] = $this->getPersistenceMapper()
                ->mapEntityToCustomerApproveProcessItemTransfer(
                    $customerApproveProcessItemEntity,
                    new CustomerApproveProcessItemTransfer()
                );
        }

        return $customerApproveProcessItems;
    }

    /**
     * @param int[] $stateIds
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer[]
     */
    public function getCustomerApproveProcessItemsByStateIds(array $stateIds = []): array
    {
        $customerApproveProcessItemEntities = $this->getCustomerApproveProcessItemQuery()
            ->filterByFkStateMachineItemState_In($stateIds)
            ->joinWithSpyStateMachineItemState(Criteria::LEFT_JOIN)
            ->joinWithSpyStateMachineProcess(Criteria::LEFT_JOIN)
            ->joinWithSpyCustomer()
            ->find();

        $customerApproveProcessItems = [];
        foreach ($customerApproveProcessItemEntities as $customerApproveProcessItemEntity) {
            $customerApproveProcessItems[] = $this->getPersistenceMapper()
                ->mapEntityToCustomerApproveProcessItemTransfer(
                    $customerApproveProcessItemEntity,
                    new CustomerApproveProcessItemTransfer()
                );
        }

        return $customerApproveProcessItems;
    }

    /**
     * @param int $itemId
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer|null
     */
    public function findCustomerApproveProcessItemById(int $itemId): ?CustomerApproveProcessItemTransfer
    {
        $customerApproveProcessItemEntity = $this->getCustomerApproveProcessItemQuery()
            ->filterByIdCustomerApproveProcessItem($itemId)
            ->joinWithSpyStateMachineItemState(Criteria::LEFT_JOIN)
            ->joinWithSpyStateMachineProcess(Criteria::LEFT_JOIN)
            ->joinWithSpyCustomer()
            ->findOne();

        if ($customerApproveProcessItemEntity === null) {
            return null;
        }

        return $this->getPersistenceMapper()
            ->mapEntityToCustomerApproveProcessItemTransfer(
                $customerApproveProcessItemEntity,
                new CustomerApproveProcessItemTransfer()
            );
    }

    /**
     * @return \Pyz\Zed\CustomerApproveProcess\Persistence\Propel\Mapper\CustomerApproveProcessPersistenceMapper
     */
    protected function getPersistenceMapper(): CustomerApproveProcessPersistenceMapper
    {
        return $this->getFactory()->createCustomerApproveProcessPersistenceMapper();
    }

    /**
     * @return \Orm\Zed\CustomerApproveProcess\Persistence\PyzCustomerApproveProcessItemQuery
     */
    protected function getCustomerApproveProcessItemQuery(): PyzCustomerApproveProcessItemQuery
    {
        return $this->getFactory()->createCustomerApproveProcessItemQuery();
    }
}
