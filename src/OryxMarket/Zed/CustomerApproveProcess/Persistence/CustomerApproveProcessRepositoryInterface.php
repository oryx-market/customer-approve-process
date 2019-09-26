<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Persistence;

use Generated\Shared\Transfer\CustomerApproveProcessItemTransfer;

interface CustomerApproveProcessRepositoryInterface
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
     * @param int $itemId
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer|null
     */
    public function findCustomerApproveProcessItemById(int $itemId): ?CustomerApproveProcessItemTransfer;
}
