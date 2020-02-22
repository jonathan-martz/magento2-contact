<?php

namespace JonathanMartz\SupportForm\Cron;

use JonathanMartz\SupportForm\Model\RequestFactory;
use JonathanMartz\SupportForm\Model\RequestRepository;
use JonathanMartz\SupportForm\Model\ResourceModel\Collection;

/**
 * Class Clear
 * @package JonathanMartz\SupportForm\Cron
 */
class Clear
{
    /**
     * @var Collection
     */
    private $supportrequest;
    private $requestFactory;
    /**
     * @var RequestRepository
     */
    private $requestRepository;


    /**
     * Clear constructor.
     * @param Collection $supportrequest
     */
    public function __construct(Collection $supportrequest, RequestFactory $requestFactory, RequestRepository $requestRepository)
    {
        $this->supportrequest = $supportrequest;
        $this->requestFactory = $requestFactory;
        $this->requestRepository = $requestRepository;
    }

    /**
     *
     */
    public function execute()
    {
        $collection = $this->supportrequest;
        $collection->addFieldToFilter('customer_id', ['eq' => null]);
        $reqeusts = $collection->getData();

        if(count($reqeusts) > 0) {
            foreach($reqeusts as $reqeust) {
                var_dump($reqeust);

                var_dump(get_class($this->requestRepository));

                // $modelUpdate->setData();
                // $modelUpdate->save();

                die();
            }
        }
    }
}
