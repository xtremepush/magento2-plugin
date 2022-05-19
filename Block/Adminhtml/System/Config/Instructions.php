<?php

namespace Xtremepush\Module\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Xtremepush\Module\Model\ModuleConfig;

class Instructions extends Field
{
    const INSTRUCTIONS_TEMPLATE = 'system/config/instructions.phtml';

    /** @var ModuleConfig */
    protected $config;

    /**
     * @param Context $context
     * @param ModuleConfig $config
     * @param array $data
     */
    public function __construct(Context $context, ModuleConfig $config, array $data = [])
    {
        $this->config = $config;
        parent::__construct($context, $data);
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();

        return parent::render($element);
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if (!$this->getTemplate()) {
            $this->setTemplate(self::INSTRUCTIONS_TEMPLATE);
        }

        return $this;
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $this->addData([
           'website_url' => $this->config->getDocumentationUrl()
       ]);

        return $this->_toHtml();
    }
}
