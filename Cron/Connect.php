<?php

namespace JonathanMartz\SupportForm\Cron;

use JonathanMartz\SupportForm\Model\RequestFactory;

/**
 * Class Connect
 * @package JonathanMartz\SupportForm\Cron
 */
class Connect
{
    /**
     * @var RequestFactory
     */
    private $supportrequest;

    /**
     * Connect constructor.
     * @param RequestFactory $supportrequest
     */
    public function __construct(RequestFactory $supportrequest)
    {
        $this->supportrequest = $supportrequest;
    }


    /**
     * @return string
     */
    public function execute()
    {
        $model = $this->supportrequest->create();

        return 'Connect';
    }
}
