<?php

namespace Xtremepush\Module\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Event\Observer;
use Magento\Sales\Api\OrderRepositoryInterface;
use Psr\Log\LoggerInterface;
use xtremepush\module\Helper\WebhookService;
use Xtremepush\Module\Model\Event;
use Xtremepush\Module\Model\ModuleConfig;
use Xtremepush\Module\Serialize\OrderSerializer;

class OrderAddressUpdatedObserver extends AbstractObserver
{
    /** @var OrderSerializer */
    private $orderSerializer;

    /** @var OrderRepositoryInterface */
    private $orderRepository;

    public function __construct(
        LoggerInterface $logger,
        WebhookService $webhookService,
        Session $authSession,
        ModuleConfig $config,
        OrderSerializer $orderSerializer,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->orderSerializer = $orderSerializer;
        $this->orderRepository = $orderRepository;
        parent::__construct($logger, $webhookService, $authSession, $config);
    }

    public function execute(Observer $observer)
    {
        if (!$order = $this->orderRepository->get($observer->getData('order_id'))) {
            return $this;
        }

        $event = Event::EVENT_ADMIN_ORDERS_ADDRESS_UPDATED;

        if ($order && $this->isWebhookEnabled($event)) {
            $this->webhookService->sendWebhook($event, $this->orderSerializer->toArray($order));
        }
        return $this;
    }
}
