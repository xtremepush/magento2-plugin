<?php

namespace Xtremepush\Core\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Xtremepush\Core\Helper\WebhookService;
use Xtremepush\Core\Model\Event;
use Xtremepush\Core\Model\ModuleConfig;
use Xtremepush\Core\Serialize\QuoteSerializer;

class CheckoutCartSavedObserver extends AbstractObserver
{
    /** @var QuoteSerializer */
    private $quoteSerializer;

    public function __construct(
        LoggerInterface $logger,
        WebhookService $webhookService,
        Session $authSession,
        ModuleConfig $config,
        QuoteSerializer $quoteSerializer
    ) {
        $this->quoteSerializer = $quoteSerializer;
        parent::__construct($logger, $webhookService, $authSession, $config);
    }

    public function execute(Observer $observer)
    {
        if (!$cart = $observer->getEvent()->getData('cart')) {
            return $this;
        }

        if (!$quote = $cart->getQuote()) {
            return $this;
        }

        if (is_null($quote->getOrigData())) {
            $event = $this->isAdmin() ? Event::EVENT_ADMIN_QUOTE_CREATED : Event::EVENT_CUSTOMER_QUOTE_CREATED;
        } else {
            $event = $this->isAdmin() ? Event::EVENT_ADMIN_QUOTE_UPDATED : Event::EVENT_CUSTOMER_QUOTE_UPDATED;
        }

        if ($this->isWebhookEnabled($event)) {
            $this->webhookService->sendWebhook($event, $this->quoteSerializer->toArray($quote));
        }

        return $this;
    }
}
