<?php

namespace JonathanMartz\SupportForm\Block;

use JonathanMartz\SupportForm\Model\ResourceModel\Collection;
use JonathanMartz\SupportForm\Model\ResourceModel\CollectionFactory;
use Magento\Backend\Block\Template;
use Magento\Customer\Model\Session;

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

    private $customerSession;


    public function __construct(
        Template\Context $context,
        Collection $supportrequest,
        Session $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->supportrequest = $supportrequest;
        $this->customerSession = $customerSession;
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        // @todo fix customer session bug ?
        $customer = $this->customerSession->getCustomer();
        if($customer) {
            $collection = $this->supportrequest;
            $collection->addFieldToFilter('customer_id', ['eq' => $customer->getId()]);
            return $collection->getData();
        }

        return [];
    }
}
