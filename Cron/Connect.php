<?php
namespace JonathanMartz\SupportForm\Cron;

use JonathanMartz\SupportForm\Model\RequestFactory;

class Connect
{
    /**
     * @var RequestFactory
     */
    private $supportrequest;

    public function __construct(RequestFactory $supportrequest)
    {
        $this->supportrequest = $supportrequest;
    }


    public function execute()
    {
        $model = $this->supportrequest->create();

        return 'Connect';
    }
}
