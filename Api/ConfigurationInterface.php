<?php

namespace Xtremepush\Core\Api;

interface ConfigurationInterface
{
    /** @return string */
    public function configure(string $xpProjectTitle, string $xpAccessToken, string $xpWebhookUrl);
}
