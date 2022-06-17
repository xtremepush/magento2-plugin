# Xtremepush for Magento 2

Use Xtremepush messaging capabilities with Magento

## Installation

### Install via composer
- inside application's main `composer.json` file add the following:
```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@bitbucket.org:xtremepush/lib-xp-magento2.git"
    },
    {
      "type": "composer",
      "url": "https://repo.magento.com/"
    }
  ]
}
```
- require the package `composer require xtremepush/lib-xp-magento2:dev-{branch name}`
- upgrade the project `php -d memory_limit=-1 bin/magento setup:upgrade`
- compile the code `php -d memory_limit=-1 bin/magento setup:di:compile`

### Install manually
- Create a new directory `/app/code/Xtremepush`
- Clone Xtremepush extension repository within this new directory
- Rename `lib-xp-magento2` directory to `Module`
- Inside root directory execute command `php -d memory_limit=-1 bin/magento setup:upgrade`
- After that execute UI update command `php bin/magento setup:static-content:deploy -f`
- Module has been installed if `Xtremepush_Module` is listed in `/app/etc/config.php`

## Required Magento permissions:
- Magento_Integration::integrations (System > System Extensions > System Integrations)
- Magento_Newsletter::subscriber (Marketing > Communications > Newsletter Subscribers)
- Magento_Sales::actions_view (Sales > Operations > Orders > Actions > View)
- Magento_Customer::customer (Customers)

