<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerApproveProcess\Communication\Controller;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\CustomerApproveProcess\Communication\CustomerApproveProcessCommunicationFactory getFactory()
 * @method \Pyz\Zed\CustomerApproveProcess\Business\CustomerApproveProcessFacadeInterface getFacade()
 */
class StateMachineItemsController extends AbstractController
{
    /**
     * @return array
     */
    public function listAction(): array
    {
        $customerApproveProcessStateItems = $this->getFacade()
            ->getAllCustomerApproveProcessItems();

        $processedStateMachineItems = $this->getStateMachineFacade()
            ->getProcessedStateMachineItems(
                $this->getStateMachineItems($customerApproveProcessStateItems)
            );

        $manualEvents = $this->getStateMachineFacade()
            ->getManualEventsForStateMachineItems($processedStateMachineItems);

        return [
            'customerApproveProcessItems' => $customerApproveProcessStateItems,
            'manualEvents' => $manualEvents,
            'stateMachineItems' => $this->createCustomerApproveProcessItemsLookupTable($processedStateMachineItems),
        ];
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addItemAction(): RedirectResponse
    {
        $customerTransfer = (new CustomerTransfer())
            ->setIdCustomer(mt_rand(1, 26));

        $this->getFacade()->createCustomerApproveProcessStateMachineItem($customerTransfer);

        return $this->redirectResponse('/customer-approve-process/state-machine-items/list');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteItemAction(Request $request): RedirectResponse
    {
        $idCustomerApproveProcessItem = $this->castId($request->query->get('id'));
        $this->getFacade()->deleteCustomerApproveProcessStateMachineItem($idCustomerApproveProcessItem);

        return $this->redirectResponse('/customer-approve-process/state-machine-items/list');
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerApproveProcessItemTransfer[] $customerApproveProcessStateItems
     *
     * @return \Generated\Shared\Transfer\StateMachineItemTransfer[]
     */
    protected function getStateMachineItems(array $customerApproveProcessStateItems): array
    {
        $stateMachineItems = [];
        foreach ($customerApproveProcessStateItems as $customerApproveProcessStateItem) {
            $stateMachineItems[] = $customerApproveProcessStateItem->getStateMachineItem();
        }

        return $stateMachineItems;
    }

    /**
     * @param \Generated\Shared\Transfer\StateMachineItemTransfer[] $stateMachineItems
     *
     * @return \Generated\Shared\Transfer\StateMachineItemTransfer[]
     */
    protected function createCustomerApproveProcessItemsLookupTable(array $stateMachineItems): array
    {
        $lookupIndex = [];
        foreach ($stateMachineItems as $stateMachineItemTransfer) {
            $lookupIndex[$stateMachineItemTransfer->getIdentifier()] = $stateMachineItemTransfer;
        }

        return $lookupIndex;
    }

    /**
     * @return \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface
     */
    protected function getStateMachineFacade(): StateMachineFacadeInterface
    {
        return $this->getFactory()->getStateMachineFacade();
    }
}
