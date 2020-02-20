<?php
namespace JonathanMartz\SupportForm\Controller\Customer;

use Magento\Framework\App\Action\Action;

/**
 * Class Index
 * @package JonathanMartz\SupportForm\Controller\Customer
 */
class Index extends Action
{
    /**
     *
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}

?>
