<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Persistence;

use Orm\Zed\CustomerApproveProcess\Persistence\PyzCustomerApproveProcessItemQuery;
use Pyz\Zed\CustomerApproveProcess\Persistence\Propel\Mapper\CustomerApproveProcessPersistenceMapper;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CustomerApproveProcessPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Pyz\Zed\CustomerApproveProcess\Persistence\Propel\Mapper\CustomerApproveProcessPersistenceMapper
     */
    public function createCustomerApproveProcessPersistenceMapper(): CustomerApproveProcessPersistenceMapper
    {
        return new CustomerApproveProcessPersistenceMapper();
    }

    /**
     * @return \Orm\Zed\CustomerApproveProcess\Persistence\PyzCustomerApproveProcessItemQuery
     */
    public function createCustomerApproveProcessItemQuery(): PyzCustomerApproveProcessItemQuery
    {
        return PyzCustomerApproveProcessItemQuery::create();
    }
}
