<?php
namespace JonathanMartz\SupportForm\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;

class Post extends Action
{
    protected $_pageFactory;

    private $jsonResultFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        JsonFactory $jsonResultFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->jsonResultFactory = $jsonResultFactory;
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $result = $this->jsonResultFactory->create();

        $result->setData(['Test-Message' => 'test']);
        return $result;
    }
}
