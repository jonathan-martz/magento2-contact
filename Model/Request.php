<?php
namespace JonathanMartz\SupportForm\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Request
 * @package JonathanMartz\SupportForm\Model
 */
class Request extends AbstractModel
{
    public function _construct()
    {
        $this->_init('JonathanMartz\SupportForm\Model\Request');
    }
}

?>
