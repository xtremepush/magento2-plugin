# Xtremepush for Magento 2

Use Xtremepush messaging capabilities with Magento

## Installation

### Install via composer
*tbd*

### Install manually
- Create a new directory `/app/code/xtremepush`
- Clone Xtremepush extension repository within this new directory
- Inside root directory execute command `php -d memory_limit=-1 bin/magento setup:upgrade`
- After that execute UI update command `php bin/magento setup:static-content:deploy -f`
- Module has been installed if `Xtremepush_Module` is listed in `/app/etc/config.php`

## Required Magento permissions:
- Magento_Integration::integrations (System > System Extensions > System Integrations)
- Magento_Newsletter::subscriber (Marketing > Communications > Newsletter Subscribers)
- Magento_Sales::actions_view (Sales > Operations > Orders > Actions > View)
- Magento_Customer::customer (Customers)

