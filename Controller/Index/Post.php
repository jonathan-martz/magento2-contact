<?php

namespace JonathanMartz\SupportForm\Controller\Index;

use JonathanMartz\SupportForm\Model\RequestFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
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
    private $remoteAddress;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var RequestFactory
     */
    protected $supportrequest;


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

    public $errors = [];

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
        Validator $formKeyValidator,
        RequestFactory $supportrequest,
        RemoteAddress $remoteAddress
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->urlModel = $urlFactory->create();
        $this->messageManager = $messageManager;
        $this->resultRedirect = $redirect;
        $this->request = $request;
        $this->formKeyValidator = $formKeyValidator;
        $this->supportrequest = $supportrequest;
        $this->remoteAddress = $remoteAddress;

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
        $empty = ['botdetect'];

        if(!$this->formKeyValidator->validate($this->getRequest())) {
            $valid = false;
        }

        if($data['agb'] !== 'on') {
            $valid = false;
            $this->errors[] = 'agb';
        }

        foreach($data as $key => $value) {
            if(empty(trim($value))) {
                $valid = false;
                $this->errors[] = $key;
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

            $ip = $this->remoteAddress->getRemoteAddress();

            $model = $this->supportrequest->create();
            $data = [
                'type' => $post['type'],
                'email' => $post['email'],
                'message' => $post['message'],
                'session' => $post['type'],
                // 'agb' => $post['agb'],
                'ip' => $ip,
                'created_at' => time()
            ];
            $model->addData($data);
            $saveData = $model->save();
        }
        else {
            $this->messageManager->addErrorMessage('Form invalid: (' . implode(', ', $this->errors) . ')');
        }

        $resultRedirect = $this->resultRedirect->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl('/supportrequest');

        return $resultRedirect;
    }
}
