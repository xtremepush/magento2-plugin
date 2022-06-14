<?php

namespace Xtremepush\Module\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Xtremepush\Module\Helper\WebhookService;
use Xtremepush\Module\Model\Event;
use Xtremepush\Module\Model\ModuleConfig;
use Xtremepush\Module\Serialize\OrderSerializer;

class OrderSavedObserver extends AbstractObserver
{
    /** @var OrderSerializer */
    private $orderSerializer;

    public function __construct(
        LoggerInterface $logger,
        WebhookService $webhookService,
        Session $authSession,
        ModuleConfig $config,
        OrderSerializer $orderSerializer
    ) {
        $this->orderSerializer = $orderSerializer;
        parent::__construct($logger, $webhookService, $authSession, $config);
    }

    public function execute(Observer $observer)
    {
        if (!$order = $observer->getEvent()->getOrder()) {
            return $this;
        }

       $orig = $order->getOrigData();

        if (!empty($orig['state']) && $orig['state'] !== $order->getState()) {
            $event = Event::getEventByState($order->getState());

            if (!empty($event) && $this->isWebhookEnabled($event)) {
                $this->webhookService->sendWebhook($event, $this->orderSerializer->toArray($order));
            }
        }

        return $this;
    }
}
