<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Business\Reader;

interface CustomerApproveProcessItemReaderInterface
{
    /**
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer[]
     */
    public function getAllStateMachineItems(): array;

    /**
     * @param int[] $stateIds
     *
     * @return \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer[]
     */
    public function getStateMachineItemsByStateIds(array $stateIds = []): array;
}
