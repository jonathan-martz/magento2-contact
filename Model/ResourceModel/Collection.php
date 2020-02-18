<?php

namespace JonathanMartz\SupportForm\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'JonathanMartz\SupportForm\Model\Request',
            'JonathanMartz\SupportForm\Model\ResourceModel\Resource'
        );
    }
}
