# Xtremepush for Magento 2

Use Xtremepush messaging capabilities with Magento

## Installation

View docs at https://docs.xtremepush.com/docs/magento-2

### Install via composer
- require the package `composer require xtremepush/magento2-plugin:dev-{branch name}`
- upgrade the project `sudo php -d memory_limit=-1 bin/magento setup:upgrade`
- compile the code `sudo php -d memory_limit=-1 bin/magento setup:di:compile`

## Required Magento permissions:
- Magento_Integration::integrations (System > System Extensions > System Integrations)
- Magento_Newsletter::subscriber (Marketing > Communications > Newsletter Subscribers)
- Magento_Sales::actions_view (Sales > Operations > Orders > Actions > View)
- Magento_Customer::customer (Customers)

