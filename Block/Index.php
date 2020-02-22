<?php

namespace JonathanMartz\SupportForm\Block;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Index
 * @package JonathanMartz\SupportForm\Block
 */
class Index extends Template
{
    /**
     * @var FormKey
     */
    private $formKey;
    /**
     * @var UrlInterface
     */
    private $url;
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param Context $context
     * @param FormKey $formKey
     * @param UrlInterface $url
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        FormKey $formKey,
        UrlInterface $url,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->formKey = $formKey;
        $this->url = $url;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return string
     */
    public function getPostUrl()
    {
        return $this->url->getUrl('supportrequest/index/post');
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }

    public function getTypes(): array
    {
        $configTypes = $this->scopeConfig->getValue('supportrequest/general/type', ScopeInterface::SCOPE_STORE);

        $types = explode(',', $configTypes);

        if(count($types) === 0) {
            return ['general'];
        }

        return $types;
    }
}
