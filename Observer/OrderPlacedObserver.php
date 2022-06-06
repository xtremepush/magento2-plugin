<?php

namespace Xtremepush\Module\Observer;

use Magento\Framework\Event\Observer;
use xtremepush\module\Model\Event;
use Xtremepush\Module\Serialize\OrderSerializer;
use Magento\Backend\Model\Auth\Session;
use Psr\Log\LoggerInterface;
use xtremepush\module\Helper\WebhookService;
use Xtremepush\Module\Model\ModuleConfig;
use Magento\Quote\Api\CartRepositoryInterface;
use Xtremepush\Module\Serialize\QuoteSerializer;

class OrderPlacedObserver extends AbstractObserver
{
    /** @var CartRepositoryInterface */
    private $quoteRepository;

    /** @var OrderSerializer */
    private $orderSerializer;

    /** @var QuoteSerializer */
    private $quoteSerializer;

    public function __construct(
        LoggerInterface $logger,
        WebhookService $webhookService,
        Session $authSession,
        ModuleConfig $config,
        CartRepositoryInterface $quoteRepository,
        OrderSerializer $orderSerializer,
        QuoteSerializer $quoteSerializer
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->orderSerializer = $orderSerializer;
        $this->quoteSerializer = $quoteSerializer;
        parent::__construct($logger, $webhookService, $authSession, $config);
    }

    public function execute(Observer $observer)
    {
        if (!$order = $observer->getEvent()->getOrder()) {
            return $this;
        }

        $quote = $this->quoteRepository->get($order->getQuoteId());

        $event = $this->isAdmin() ? Event::EVENT_ADMIN_QUOTE_COMPLETED : Event::EVENT_CUSTOMER_QUOTE_COMPLETED;
        if ($quote && $this->isWebhookEnabled($event)) {
            $this->webhookService->sendWebhook($event, $this->quoteSerializer->toArray($quote));
        }

        $event = $this->isAdmin() ? Event::EVENT_ADMIN_ORDER_CREATED : Event::EVENT_CUSTOMER_ORDER_CREATED;
        if ($this->isWebhookEnabled($event)) {
            $this->webhookService->sendWebhook($event, $this->orderSerializer->toArray($order));
        }

        return $this;
    }
}
