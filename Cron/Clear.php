<?php

namespace JonathanMartz\SupportForm\Cron;

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

    /**
     * Clear constructor.
     * @param Collection $supportrequest
     */
    public function __construct(Collection $supportrequest)
    {
        $this->supportrequest = $supportrequest;
    }

    /**
     *
     */
    public function execute()
    {
        $collection = $this->supportrequest;
        $collection->addFieldToFilter('customer_id', ['neq' => '']);

        var_dump($collection->getData());
    }
}
