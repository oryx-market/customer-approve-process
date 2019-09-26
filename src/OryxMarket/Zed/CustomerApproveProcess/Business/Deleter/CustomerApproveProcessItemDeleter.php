<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Business\Deleter;

use Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessEntityManagerInterface;

class CustomerApproveProcessItemDeleter implements CustomerApproveProcessItemDeleterInterface
{
    /**
     * @var \Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \Pyz\Zed\CustomerApproveProcess\Persistence\CustomerApproveProcessEntityManagerInterface $entityManager
     */
    public function __construct(CustomerApproveProcessEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param int $customerApproveProcessItemId
     *
     * @return void
     */
    public function deleteCustomerApproveProcessItem(int $customerApproveProcessItemId): void
    {
        $this->entityManager->deleteCustomerApproveProcessItemEntity($customerApproveProcessItemId);
    }
}
