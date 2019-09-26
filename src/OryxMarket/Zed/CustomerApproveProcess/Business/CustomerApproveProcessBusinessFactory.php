<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Business;

use Pyz\Zed\CustomerApproveProcess\Business\Deleter\CustomerApproveProcessItemDeleter;
use Pyz\Zed\CustomerApproveProcess\Business\Deleter\CustomerApproveProcessItemDeleterInterface;
use Pyz\Zed\CustomerApproveProcess\Business\Reader\CustomerApproveProcessItemReader;
use Pyz\Zed\CustomerApproveProcess\Business\Reader\CustomerApproveProcessItemReaderInterface;
use Pyz\Zed\CustomerApproveProcess\Business\Writer\CustomerApproveProcessItemWriter;
use Pyz\Zed\CustomerApproveProcess\Business\Writer\CustomerApproveProcessItemWriterInterface;
use Pyz\Zed\CustomerApproveProcess\CustomerApproveProcessDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface;

/**
 * @method \Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessRepositoryInterface getRepository()
 * @method \Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessEntityManagerInterface getEntityManager()
 */
class CustomerApproveProcessBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\CustomerApproveProcess\Business\Reader\CustomerApproveProcessItemReaderInterface
     */
    public function createCustomerApproveProcessItemReader(): CustomerApproveProcessItemReaderInterface
    {
        return new CustomerApproveProcessItemReader(
            $this->getStateMachineFacade(),
            $this->getRepository()
        );
    }

    /**
     * @return \Pyz\Zed\CustomerApproveProcess\Business\Writer\CustomerApproveProcessItemWriterInterface
     */
    public function createCustomerApproveProcessItemWriter(): CustomerApproveProcessItemWriterInterface
    {
        return new CustomerApproveProcessItemWriter(
            $this->getStateMachineFacade(),
            $this->getRepository(),
            $this->getEntityManager()
        );
    }

    /**
     * @return \Pyz\Zed\CustomerApproveProcess\Business\Deleter\CustomerApproveProcessItemDeleterInterface
     */
    public function createCustomerApproveProcessItemDeleter(): CustomerApproveProcessItemDeleterInterface
    {
        return new CustomerApproveProcessItemDeleter($this->getEntityManager());
    }

    /**
     * @return \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface
     */
    public function getStateMachineFacade(): StateMachineFacadeInterface
    {
        return $this->getProvidedDependency(CustomerApproveProcessDependencyProvider::FACADE_STATE_MACHINE);
    }
}
