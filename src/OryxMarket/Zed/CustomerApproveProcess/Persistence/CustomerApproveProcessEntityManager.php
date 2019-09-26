<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Persistence;

use Generated\Shared\Transfer\CustomerApproveProcessItemTransfer;
use Orm\Zed\CustomerApproveProcess\Persistence\PyzCustomerApproveProcessItemQuery;
use Pyz\Zed\CustomerApproveProcess\Persistence\Propel\Mapper\CustomerApproveProcessPersistenceMapper;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessPersistenceFactory getFactory()
 */
class CustomerApproveProcessEntityManager extends AbstractEntityManager implements CustomerApproveProcessEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer $customerApproveProcessItemTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer
     */
    public function saveCustomerApproveProcessItemEntity(
        CustomerApproveProcessItemTransfer $customerApproveProcessItemTransfer
    ): CustomerApproveProcessItemTransfer {
        $customerApproveProcessItemEntity = $this->getCustomerApproveProcessItemQuery()
            ->filterByIdCustomerApproveProcessItem($customerApproveProcessItemTransfer->getIdCustomerApproveProcessItem())
            ->findOneOrCreate();

        $customerApproveProcessItemEntity
            ->setFkCustomer($customerApproveProcessItemTransfer->getIdCustomer());

        if ($customerApproveProcessItemTransfer->getStateMachineItem() !== null) {
            $customerApproveProcessItemEntity
                ->setFkStateMachineItemState($customerApproveProcessItemTransfer->getStateMachineItem()->getIdItemState())
                ->setFkStateMachineProcess($customerApproveProcessItemTransfer->getStateMachineItem()->getIdStateMachineProcess());
        }

        $customerApproveProcessItemEntity->save();

        return $this->getPersistenceMapper()
            ->mapEntityToCustomerApproveProcessItemTransfer(
                $customerApproveProcessItemEntity,
                $customerApproveProcessItemTransfer
            );
    }

    /**
     * @param int $idCustomerApproveProcessItem
     *
     * @return void
     */
    public function deleteCustomerApproveProcessItemEntity(int $idCustomerApproveProcessItem): void
    {
        $customerApproveProcessItemEntity = $this->getCustomerApproveProcessItemQuery()
            ->filterByIdCustomerApproveProcessItem($idCustomerApproveProcessItem)
            ->findOne();

        if ($customerApproveProcessItemEntity === null) {
            return;
        }

        $customerApproveProcessItemEntity->delete();
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
