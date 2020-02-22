<?php

namespace JonathanMartz\SupportForm\Cron;

use Exception;
use JonathanMartz\SupportForm\Model\RequestFactory;
use JonathanMartz\SupportForm\Model\ResourceModel\CollectionFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;

/**
 * Class Connect
 * @package JonathanMartz\SupportForm\Cron
 */
class Connect
{
    /**
     * @var CollectionFactory
     */
    private $supportrequest;
    /**
     * @var RequestFactory
     */
    private $requestFactory;
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var
     */
    protected $scopeConfig;


    /**
     * Clear constructor.
     * @param CollectionFactory $supportrequest
     * @param RequestFactory $requestFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        CollectionFactory $supportrequest,
        RequestFactory $requestFactory,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->supportrequest = $supportrequest;
        $this->requestFactory = $requestFactory;
        $this->customerRepository = $customerRepository;
    }

    /**
     *
     */
    public function execute()
    {
        $collection = $this->supportrequest->create();
        $collection->addFieldToFilter('customer_id', ['eq' => null])->setPageSize(10)->setCurPage(1);
        $requests = $collection->getItems();

        if(count($requests) > 0) {
            foreach($requests as $id => $model) {

                try {
                    $customer = $this->customerRepository->get($model->getData('email'), 1);

                    if(!empty($customer->getId())) {
                        $model->setData('customer_id', $customer->getId());
                        $model->save();
                    }
                }
                catch(Exception $e) {
                    // do nothing
                }
            }
        }
    }
}
