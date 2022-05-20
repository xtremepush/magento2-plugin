<?php

namespace Xtremepush\Module\Api;

interface ConfigurationInterface
{
    /** @return string */
    public function configure(string $xpProjectTitle, string $xpAccessToken, string $xpWebhookUrl);
}
