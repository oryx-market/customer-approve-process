<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Communication\Plugin;

use Generated\Shared\Transfer\StateMachineItemTransfer;
use Pyz\Zed\CustomerApproveProcess\Communication\Plugin\Command\CustomerApproveProcessCommandPlugin;
use Pyz\Zed\CustomerApproveProcess\Communication\Plugin\Condition\CustomerApproveProcessConditionPlugin;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\StateMachine\Dependency\Plugin\StateMachineHandlerInterface;

/**
 * @method \Pyz\Zed\CustomerApproveProcess\Business\CustomerApproveProcessFacadeInterface getFacade()
 */
class CustomerApproveProcessStateMachineHandlerPlugin extends AbstractPlugin implements StateMachineHandlerInterface
{
    /**
     * List of command plugins for this state machine for all processes.
     *
     * @return \Spryker\Zed\StateMachine\Dependency\Plugin\CommandPluginInterface[]
     */
    public function getCommandPlugins(): array
    {
        return [
            'CustomerApproveProcess/CustomerApproveProcessCommand' => new CustomerApproveProcessCommandPlugin(),
        ];
    }

    /**
     * List of condition plugins for this state machine for all processes.
     *
     * @return \Spryker\Zed\StateMachine\Dependency\Plugin\ConditionPluginInterface[]
     */
    public function getConditionPlugins(): array
    {
        return [
            'CustomerApproveProcess/CustomerApproveProcessCondition' => new CustomerApproveProcessConditionPlugin(),
        ];
    }

    /**
     * Name of state machine used by this handler.
     *
     * @return string
     */
    public function getStateMachineName(): string
    {
        return 'CustomerApproveProcess';
    }

    /**
     * List of active processes used for this state machine
     *
     * @return string[]
     */
    public function getActiveProcesses(): array
    {
        return [
            'Process01',
        ];
    }

    /**
     * Provide initial state name for item when state machine initialized. Using process name.
     *
     * @param string $processName
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    public function getInitialStateForProcess($processName): string
    {
        return 'new';
    }

    /**
     * This method is called when state of item was changed, client can create custom logic for example update it's related table with new state id/name.
     * StateMachineItemTransfer:identifier is id of entity from implementor.
     *
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer $stateMachineItemTransfer
     *
     * @return bool
     */
    public function itemStateUpdated(StateMachineItemTransfer $stateMachineItemTransfer): bool
    {
        $customerApproveProcessItemTransfer = $this->getFacade()
            ->updateCustomerApproveProcessStateMachineItem($stateMachineItemTransfer);

        if ($customerApproveProcessItemTransfer->getIdCustomerApproveProcessItem()) {
            return true;
        }

        return false;
    }

    /**
     * This method should return all list of StateMachineItemTransfer, with (identifier, IdStateMachineProcess, IdItemState)
     *
     * @param array $stateIds
     *
     * @return \Generated\Shared\Transfer\StateMachineItemTransfer[]
     */
    public function getStateMachineItemsByStateIds(array $stateIds = []): array
    {
        $customerApproveProcessItems = $this->getFacade()->getCustomerApproveProcessItemsByStateIds($stateIds);
        $stateMachineItems = [];
        foreach ($customerApproveProcessItems as $customerApproveProcessItem) {
            $stateMachineItems[] = $customerApproveProcessItem->getStateMachineItem();
        }

        return $stateMachineItems;
    }
}
