<?php

namespace JonathanMartz\SupportForm\Block;

use JonathanMartz\SupportForm\Model\ResourceModel\Collection;
use JonathanMartz\SupportForm\Model\ResourceModel\CollectionFactory;
use Magento\Backend\Block\Template;

/**
 * Class Overview
 * @package JonathanMartz\SupportForm\Block
 */
class Overview extends Template
{
    /**
     * @var CollectionFactory
     */
    private $supportrequest;

    public function __construct(
        Template\Context $context,
        array $data = [],
        Collection $supportrequest
    ) {
        parent::__construct($context, $data);
        $this->supportrequest = $supportrequest;
    }

    public function getList(): array
    {

        $collection = $this->supportrequest;
        $collection->addFieldToFilter('customer_id', ['neq' => '']);

        return $collection->getData();
    }
}
