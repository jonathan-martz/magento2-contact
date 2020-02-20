<?php

namespace JonathanMartz\SupportForm\Block;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;

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
     * @param Context $context
     * @param FormKey $formKey
     * @param UrlInterface $url
     * @param array $data
     */
    public function __construct(
        Context $context,
        FormKey $formKey,
        UrlInterface $url,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->formKey = $formKey;
        $this->url = $url;
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
}
