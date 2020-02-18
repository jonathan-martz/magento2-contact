<?php

namespace JonathanMartz\SupportForm\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\UrlFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Post
 * @package JonathanMartz\SupportForm\Controller\Index
 */
class Post extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var UrlFactory
     */
    protected $urlFactory;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;
    /**
     * @var UrlInterface
     */
    private $urlModel;
    /**
     * @var ResultFactory
     */
    private $resultRedirect;
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param JsonFactory $resultJsonFactory
     * @param ManagerInterface $messageManager
     * @param UrlFactory $urlFactory
     * @param ResultFactory $result
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        ManagerInterface $messageManager,
        UrlFactory $urlFactory,
        ResultFactory $redirect,
        RequestInterface $request,
        Validator $formKeyValidator
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->urlModel = $urlFactory->create();
        $this->messageManager = $messageManager;
        $this->resultRedirect = $redirect;
        $this->request = $request;
        $this->formKeyValidator = $formKeyValidator;

        parent::__construct($context);
    }

    /**
     * @var Validator
     */
    protected $formKeyValidator;

    /**
     * @param array $data
     * @return bool
     */
    public function validate(array $data)
    {
        $valid = true;
        $error = [];
        $empty = ['botdetect'];

        if(!$this->formKeyValidator->validate($this->getRequest())) {
            $valid = false;
        }

        foreach($data as $key => $value) {
            if(empty(trim($value))) {
                $valid = false;
                $error[] = $key;
            }
        }

        return $valid;
    }


    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $post = $this->request->getPostValue();
        $validate = $this->validate($post);

        if($validate) {
            $this->messageManager->addSuccessMessage('Formular wurde erfolgreich übermittelt');
        }
        else {
            $this->messageManager->addErrorMessage('Form invalid: (' . implode($error) . ')');
        }

        $resultRedirect = $this->resultRedirect->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl('/supportrequest');

        return $resultRedirect;
    }
}
