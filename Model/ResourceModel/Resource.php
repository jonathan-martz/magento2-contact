<?php
namespace JonathanMartz\SupportForm\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Resource
 * @package JonathanMartz\SupportForm\Model\ResourceModel
 */
class Resource extends AbstractDb
{
    /**
     *
     */
    public function _construct()
    {
        $this->_init("support_request", "id");
    }
}

?>
