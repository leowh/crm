<?php
/**
 * The control file for purchase of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     purchase
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
class purchase extends control
{
    /**
     * Construct method.
     * 
     * @param  string $moduleName 
     * @param  string $methodName 
     * @param  string $appName 
     * @access public
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
	$this->loadModel('contract','crm');
	$this->loadModel('trade');
    }

    /**
     * Contract index page. 
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        $this->locate(inlink('browse'));
    }

    /**
     * Browse all purchases; 
     * 
     * @param  string $mode 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function browse($mode = 'all', $orderBy = 'id_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {   
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $purchases = $this->purchase->getList(0, $mode, 'purchase', $orderBy, $pager);

        /* Set preAndNext condition. */
        $this->session->set('purchaseQueryCondition', $this->dao->get());

        /* Save session for return link. */
        $this->session->set('purchaseList', $this->app->getURI(true));

	/* Build search form. */
        $this->loadModel('search', 'sys');
        $this->config->purchase->search['actionURL'] = $this->createLink('purchase', 'browse', 'mode=bysearch');
        $this->search->setSearchParams($this->config->purchase->search);

       	$this->view->title        = $this->lang->purchase->browse;
        $this->view->purchases    = $purchases;
        $this->view->customers    = $this->loadModel('customer','crm')->getPairs('provider');
        $this->view->pager        = $pager;
        $this->view->mode         = $mode;
        $this->view->orderBy      = $orderBy;
        $this->view->currencySign = $this->loadModel('common', 'sys')->getCurrencySign();
        $this->view->currencyList = $this->common->getCurrencyList();
        if($purchases) $this->view->totalAmount = $this->purchase->countAmount($purchases);

        $this->display();
    }

    /**
     * Create purchase. 
     * 
     * @param  int    $customerID
     * @param  int    $orderID 
     * @access public
     * @return void
     */
    public function create($customerID = 0, $orderID = 0)
    {
        if($_POST)
        {
            $purchaseID = $this->purchase->create();
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            $this->loadModel('action')->create('contract', $purchaseID, 'Created');
            $this->loadModel('action')->create('customer', $this->post->customer, 'createContract', '', html::a($this->createLink('purchase', 'view', "purchaseID=$purchaseID"), $this->post->name));

            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('browse')));
        }

        unset($this->lang->purchase->menu);
        $this->view->title        = $this->lang->purchase->create;
        $this->view->orderID      = $orderID;
        $this->view->customers    = $this->loadModel('customer','crm')->getPairs('provider');
        $this->view->users        = $this->loadModel('user')->getPairs('nodeleted,noclosed');
        $this->view->currencyList = $this->loadModel('common', 'sys')->getCurrencyList();
        $this->view->currencySign = $this->loadModel('common', 'sys')->getCurrencySign();
        $this->display();
    }

    /**
     * Edit purchase.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return void
     */
    public function edit($purchaseID)
    {
        $purchase = $this->purchase->getByID($purchaseID);

        if($_POST)
        {
            $changes = $this->purchase->update($purchaseID);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $files = $this->loadModel('file')->saveUpload('contract', $purchaseID);

            if($changes or $files)
            {
                $fileAction = '';
                if($files) $fileAction = $this->lang->addFiles . join(',', $files);

                $purchaseActionID = $this->loadModel('action')->create('contract', $purchaseID, 'Edited', $fileAction);
                if($changes) $this->action->logHistory($purchaseActionID, $changes);

                $customerActionID = $this->loadModel('action')->create('customer', $purchase->customer, 'editContract', $fileAction, html::a($this->createLink('purchase', 'view', "purchaseID=$purchaseID"), $purchase->name));
                if($changes) $this->action->logHistory($customerActionID, $changes);

                if($purchase->order)
                {
                    foreach($purchase->order as $orderID)
                    {
                        $orderActionID = $this->loadModel('action')->create('order', $orderID, 'editContract', $fileAction, html::a($this->createLink('purchase', 'view', "purchaseID=$purchaseID"), $purchase->name));
                        if($changes) $this->action->logHistory($orderActionID, $changes);
                    }
                }
            }

            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('view', "purchaseID=$purchaseID")));
        }

        $this->view->title          = $this->lang->purchase->edit;
        $this->view->purchase       = $purchase; 
        $this->view->purchaseOrders = $this->loadModel('order','crm')->getByIdList($purchase->order);
        $this->view->orders         = array('' => '') + $this->order->getList($mode = 'query', "customer={$purchase->customer}");
        $this->view->customers      = $this->loadModel('customer','crm')->getPairs('provider');
        $this->view->contacts       = $this->loadModel('contact','crm')->getPairs($purchase->customer);
        $this->view->users          = $this->loadModel('user')->getPairs('nodeleted,noclosed');
        $this->view->currencyList   = $this->loadModel('common', 'sys')->getCurrencyList();
        $this->view->currencySign   = $this->loadModel('common', 'sys')->getCurrencySign();
        $this->display();
    }

    /**
     * The delivery of the purchase.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return void
     */
    public function delivery($purchaseID)
    {
        $purchase = $this->purchase->getByID($purchaseID);
        if(!empty($_POST))
        {
            $this->purchase->delivery($purchaseID);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            if($this->post->finish)
            {
                $this->loadModel('action')->create('contract', $purchaseID, 'finishDelivered', $this->post->comment, '', $this->post->deliveredBy);
                $this->loadModel('action')->create('customer', $purchase->customer, 'finishDeliverContract', $this->post->comment, html::a($this->createLink('purchase', 'view', "purchaseID=$purchaseID"), $purchase->name), $this->post->deliveredBy);
            }
            else
            {
                $this->loadModel('action')->create('contract', $purchaseID, 'Delivered', $this->post->comment, '', $this->post->deliveredBy);
                $this->loadModel('action')->create('customer', $purchase->customer, 'deliverContract', $this->post->comment, html::a($this->createLink('purchase', 'view', "purchaseID=$purchaseID"), $purchase->name), $this->post->deliveredBy);
            }

            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => 'reload'));
        }

        $this->view->title      = $this->lang->purchase->delivery;
        $this->view->purchaseID = $purchaseID;
        $this->view->users      = $this->loadModel('user')->getPairs();
        $this->display();
    }

    /**
     * Edit delivery.
     * 
     * @param  int    $deliveryID 
     * @access public
     * @return void
     */
    public function editDelivery($deliveryID)
    {
        $delivery = $this->purchase->getDeliveryByID($deliveryID);
        $purchase = $this->purchase->getByID($delivery->contract);
        if(!empty($_POST))
        {
            $this->purchase->editDelivery($delivery, $purchase);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => 'reload'));
        }

        $this->view->title    = $this->lang->purchase->editDelivery;
        $this->view->delivery = $delivery;
        $this->view->purchase = $purchase;
        $this->view->users    = $this->loadModel('user')->getPairs();
        $this->display();
    }

    /**
     * Delete delivery.
     * 
     * @param  int    $deliveryID 
     * @access public
     * @return void
     */
    public function deleteDelivery($deliveryID)
    {
        $delivery = $this->purchase->getDeliveryByID($deliveryID);
        $purchase = $this->purchase->getByID($delivery->purchase);

        $this->purchase->deleteDelivery($deliveryID);
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

        $deleteInfo = sprintf($this->lang->purchase->deleteDeliveryInfo, $delivery->deliveredDate);
        $this->loadModel('action')->create('contract', $purchase->id, 'deletedelivered', '', $deleteInfo);

        $actionExtra = html::a($this->createLink('purchase', 'view', "purchaseID=$purchase->id"), $purchase->name) . $deleteInfo; 
        $this->loadModel('action')->create('customer', $purchase->customer, 'deletedelivered', $this->post->comment, $actionExtra, $this->post->returnedBy);

        $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
    }

    /**
     * Receive payments of the purchase.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return void
     */
    public function receive($purchaseID)
    {
        $purchase      = $this->purchase->getByID($purchaseID);
        $currencySign  = $this->loadModel('common', 'sys')->getCurrencySign();
        $users         = $this->loadModel('user')->getPairs();
	$depositorList = array('' => '') + $this->loadModel('depositor','cash')->getPairs();
        $categories    = $this->loadModel('tree')->getOptionMenu('out', 0, $removeRoot = true);


        if(!empty($_POST))
        {
            $this->purchase->receive($purchaseID);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            $actionExtra = html::a($this->createLink('purchase', 'view', "purchaseID=$purchaseID"), $purchase->name) . $this->lang->purchase->return . zget($currencySign, $purchase->currency, '') . $this->post->amount;

            if($this->post->finish)
            {
                $this->loadModel('action')->create('contract', $purchaseID, 'finishReturned', $this->post->comment, zget($currencySign, $purchase->currency, '') . $this->post->amount, $this->post->returnedBy);
                $this->loadModel('action')->create('customer', $purchase->customer, 'finishReceiveContract', $this->post->comment, $actionExtra, $this->post->returnedBy);
            }
            else
            {
                $this->loadModel('action')->create('contract', $purchaseID, 'returned', $this->post->comment, zget($currencySign, $purchase->currency, '') . $this->post->amount, $this->post->returnedBy);
                $this->loadModel('action')->create('customer', $purchase->customer, 'receiveContract', $this->post->comment, $actionExtra, $this->post->returnedBy);
            }
            
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => 'reload'));
        }

        $this->view->title         = $purchase->name;
	$this->view->categories    = $categories;
	$this->view->depositorList = $depositorList;
        $this->view->purchase      = $purchase;
        $this->view->users         = $users;
        $this->view->currencySign  = $currencySign;

        $this->display();
    }

    /**
     * Edit return.
     * 
     * @param  int    $returnID 
     * @access public
     * @return void
     */
    public function editReturn($returnID)
    {
        $return       = $this->purchase->getReturnByID($returnID);
        $purchase     = $this->purchase->getByID($return->purchase);
        $currencySign = $this->loadModel('common', 'sys')->getCurrencySign();
        if(!empty($_POST))
        {
            $this->purchase->editReturn($return, $purchase);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => 'reload'));
        }

        $this->view->title        = $this->lang->purchase->editReturn;
        $this->view->return       = $return;
        $this->view->purchase     = $purchase;
        $this->view->users        = $this->loadModel('user')->getPairs();
        $this->view->currencySign = $currencySign;
        $this->display();
    }

    /**
     * Delete return.
     * 
     * @param  int    $returnID 
     * @access public
     * @return void
     */
    public function deleteReturn($returnID)
    {
        $return   = $this->purchase->getReturnByID($returnID);
        $purchase = $this->purchase->getByID($return->purchase);
        $currencySign = $this->loadModel('common', 'sys')->getCurrencySign();

        $this->purchase->deleteReturn($returnID);
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

        $deleteInfo = sprintf($this->lang->purchase->deleteReturnInfo, $return->returnedDate, zget($currencySign, $purchase->currency, '') . $return->amount);
        $this->loadModel('action')->create('contract', $purchase->id, 'deletereturned', '', $deleteInfo);

        $actionExtra = html::a($this->createLink('purchase', 'view', "purchaseID=$purchase->id"), $purchase->name) . $deleteInfo; 
        $this->loadModel('action')->create('customer', $purchase->customer, 'deletereturned', $this->post->comment, $actionExtra, $this->post->returnedBy);

        $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
    }

    /**
     * Cancel purchase.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return void
     */
    public function cancel($purchaseID)
    {
        $purchase = $this->purchase->getByID($purchaseID);
        if(!empty($_POST))
        {
            $this->purchase->cancel($purchaseID);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            $this->loadModel('action');
            $this->action->create('contract', $purchaseID, 'Canceled', $this->post->comment);
            $this->action->create('customer', $purchase->customer, 'cancelContract', $this->post->comment, html::a($this->createLink('purchase', 'view', "purchaseID=$purchaseID"), $purchase->name));

            if($purchase->order)
            {
                foreach($purchase->order as $orderID)
                {
                    $this->action->create('order', $orderID, 'cancelContract', $this->post->comment, html::a($this->createLink('purchase', 'view', "purchaseID=$purchaseID"), $purchase->name));
                }
            }
            
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => 'reload'));
        }

        $this->view->title      = $this->lang->cancel;
        $this->view->purchaseID = $purchaseID;
        $this->display();
    }

    /**
     * Finish purchase.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return void
     */
    public function finish($purchaseID)
    {
        $purchase = $this->purchase->getByID($purchaseID);
        if(!empty($_POST))
        {
            $this->purchase->finish($purchaseID);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            $this->loadModel('action')->create('contract', $purchaseID, 'Finished', $this->post->comment);
            $this->loadModel('action')->create('customer', $purchase->customer, 'finishContract', $this->post->comment, html::a($this->createLink('purchase', 'view', "purchaseID=$purchaseID"), $purchase->name));

            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => 'reload'));
        }

        $this->view->title      = $this->lang->finish;
        $this->view->purchaseID = $purchaseID;
        $this->display();
    }
    /**
     * View purchase. 
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return void
     */
    public function view($purchaseID)
    {
        $purchase = $this->purchase->getByID($purchaseID);

        /* Save session for return link. */
        $uri = $this->app->getURI(true);
        $this->session->set('customerList', $uri);
        $this->session->set('contactList',  $uri);
        if(!$this->session->orderList) $this->session->set('orderList', $uri);

        $this->view->title        = $this->lang->purchase->view;
        $this->view->orders       = $this->loadModel('order','crm')->getByIdList($purchase->order);
        $this->view->customers    = $this->loadModel('customer','crm')->getPairs('provider');
        $this->view->contacts     = $this->loadModel('contact','crm')->getPairs($purchase->customer);
        $this->view->products     = $this->loadModel('product','crm')->getPairs();
        $this->view->users        = $this->loadModel('user')->getPairs();
        $this->view->purchase     = $purchase;
        $this->view->actions      = $this->loadModel('action')->getList('contract', $purchaseID);
        $this->view->currencySign = $this->loadModel('common', 'sys')->getCurrencySign();
        $this->view->preAndNext   = $this->common->getPreAndNextObject('contract', $purchaseID);

        $this->display();
    }

    /**
     * View purchase. 
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return void
     */
    public function viewFromTrade($purchaseID)
    {
        $purchase = $this->purchase->getByID($purchaseID);

        /* Save session for return link. */
        $uri = $this->app->getURI(true);
        $this->session->set('customerList', $uri);
        $this->session->set('contactList',  $uri);
        if(!$this->session->orderList) $this->session->set('orderList', $uri);

        $this->view->title        = $this->lang->purchase->view;
        $this->view->orders       = $this->loadModel('order','crm')->getByIdList($purchase->order);
        $this->view->customers    = $this->loadModel('customer','crm')->getPairs('provider');
        $this->view->contacts     = $this->loadModel('contact','crm')->getPairs($purchase->customer);
        $this->view->products     = $this->loadModel('product','crm')->getPairs();
        $this->view->users        = $this->loadModel('user')->getPairs();
        $this->view->purchase     = $purchase;
        $this->view->actions      = $this->loadModel('action')->getList('contract', $purchaseID);
        $this->view->currencySign = $this->loadModel('common', 'sys')->getCurrencySign();
        $this->view->preAndNext   = $this->common->getPreAndNextObject('contract', $purchaseID);

        $this->display();
    }

    /**
     * Delete purchase. 
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return void
     */
    public function delete($purchaseID)
    {
	$this->dao->delete()->from(TABLE_CONTRACT)->where('id')->eq($purchaseID)->exec();
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success', 'locate' => inlink('browse')));
    }

    /**
     * Get order.
     *
     * @param  int       $customerID
     * @param  string    $status
     * @access public
     * @return string
     */
    public function getOrder($customerID, $status = '')
    {
        $orders = $this->loadModel('order')->getOrderForCustomer($customerID, $status);

        $html = "<div class='form-group'><span class='col-sm-7'><select name='order[]' class='select-order form-control'>";

        foreach($orders as $order)
        {
            if(empty($order))
            {
                $html .= "<option value='' data-real='' data-currency=''></option>";
            }
            else
            {
                $html .= "<option value='{$order->id}' data-real='{$order->plan}' data-currency='{$order->currency}'>{$order->title}</option>";
            }
        }

        $html .= '</select></span>';
        $html .= "<span class='col-sm-4'><div class='input-group'><div class='input-group-addon order-currency'></div>" . html::input('real[]', '', "class='order-real form-control' placeholder='{$this->lang->purchase->placeholder->real}'") . "</div></span>";
        $html .= "<span class='col-sm-1'>" . html::a('javascript:;', "<i class='icon-plus'></i>", "class='plus'") . html::a('javascript:;', "<i class='icon-remove'></i>", "class='minus'") . "</span></div>";

        echo $html;
    }

    /**
     * Get option menu.
     * 
     * @param  int    $customer 
     * @access public
     * @return void
     */
    public function getOptionMenu($customer)
    {
        $purchaseList = $this->purchase->getList($customer);
        echo "<option value=''></option>";
        foreach($purchaseList as $id => $purchase) echo "<option value='{$id}' data-amount='{$purchase->amount}'>{$purchase->name}</option>";
        exit;
    }

    /**
     * get data to export.
     * 
     * @param  string $mode 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function export($mode = 'all', $orderBy = 'id_desc')
    { 
        if($_POST)
        {
            $purchaseLang   = $this->lang->purchase;
            $purchaseConfig = $this->config->purchase;

            /* Create field lists. */
            $fields = explode(',', $purchaseConfig->list->exportFields);
            foreach($fields as $key => $fieldName)
            {
                $fieldName = trim($fieldName);
                $fields[$fieldName] = isset($purchaseLang->$fieldName) ? $purchaseLang->$fieldName : $fieldName;
                unset($fields[$key]);
            }

            $purchases = array();
            if($mode == 'all')
            {
                $purchaseQueryCondition = $this->session->purchaseQueryCondition;
                if(strpos($purchaseQueryCondition, 'limit') !== false) $purchaseQueryCondition = substr($purchaseQueryCondition, 0, strpos($purchaseQueryCondition, 'limit'));
                $stmt = $this->dbh->query($purchaseQueryCondition);
                while($row = $stmt->fetch()) $purchases[$row->id] = $row;
            }

            if($mode == 'thisPage')
            {
                $stmt = $this->dbh->query($this->session->purchaseQueryCondition);
                while($row = $stmt->fetch()) $purchases[$row->id] = $row;
            }

            $users        = $this->loadModel('user')->getPairs('noletter');
            $customers    = $this->loadModel('customer')->getPairs();
            $contacts     = $this->loadModel('contact')->getPairs();
            $relatedFiles = $this->dao->select('id, objectID, pathname, title')->from(TABLE_FILE)->where('objectType')->eq('contract')->andWhere('objectID')->in(@array_keys($purchases))->fetchGroup('objectID');

            $purchaseOrderList = $this->dao->select('*')->from(TABLE_CONTRACTORDER)->fetchGroup('contract');
            foreach($purchases as $id => $purchase)
            {
                $purchase->order = array();
                if(isset($purchaseOrderList[$id]))
                {
                    foreach($purchaseOrderList[$id] as $purchaseOrder)
                    {
                        $purchase->order[] = $purchaseOrder->order;
                    }
                }
            }

            /* Get related products names. */
            $orderPairs = array();
            $orders = $this->dao->select('*')->from(TABLE_ORDER)->fetchAll('id');
            $this->loadModel('order')->setProductsForOrders($orders);
            foreach($orders as $key => $order)
            {
                $productName = count($order->products) > 1 ? current($order->products) . $this->lang->etc : current($order->products);
                $orderPairs[$key] = sprintf($this->lang->order->titleLBL, $customers[$order->customer], $productName, date('Y-m-d', strtotime($order->createdDate))); 
            }

            foreach($purchases as $purchase)
            {
                $purchase->items = htmlspecialchars_decode($purchase->items);
                $purchase->items = str_replace("<br />", "\n", $purchase->items);
                $purchase->items = str_replace('"', '""', $purchase->items);

                /* fill some field with useful value. */
                if(isset($customers[$purchase->customer])) $purchase->customer = $customers[$purchase->customer] . "(#$purchase->customer)";
                if(isset($contacts[$purchase->contact]))   $purchase->contact  = $contacts[$purchase->contact] . "(#$purchase->contact)";

                if(isset($purchaseLang->statusList[$purchase->status]))     $purchase->status   = $purchaseLang->statusList[$purchase->status];
                if(isset($purchaseLang->deliveryList[$purchase->delivery])) $purchase->delivery = $purchaseLang->deliveryList[$purchase->delivery];
                if(isset($purchaseLang->returnList[$purchase->return]))     $purchase->return   = $purchaseLang->returnList[$purchase->return];
                if(isset($this->lang->currencyList[$purchase->currency]))   $purchase->currency = $this->lang->currencyList[$purchase->currency];

                if(isset($users[$purchase->createdBy]))   $purchase->createdBy   = $users[$purchase->createdBy];
                if(isset($users[$purchase->editedBy]))    $purchase->editedBy    = $users[$purchase->editedBy];
                if(isset($users[$purchase->signedBy]))    $purchase->signedBy    = $users[$purchase->signedBy];
                if(isset($users[$purchase->deliveredBy])) $purchase->deliveredBy = $users[$purchase->deliveredBy];
                if(isset($users[$purchase->returnedBy]))  $purchase->returnedBy  = $users[$purchase->returnedBy];
                if(isset($users[$purchase->finishedBy]))  $purchase->finishedBy  = $users[$purchase->finishedBy];
                if(isset($users[$purchase->canceledBy]))  $purchase->canceledBy  = $users[$purchase->canceledBy];
                if(isset($users[$purchase->contactedBy])) $purchase->contactedBy = $users[$purchase->contactedBy];

                $purchase->begin          = substr($purchase->begin, 0, 10);
                $purchase->end            = substr($purchase->end, 0, 10);
                $purchase->createdDate    = substr($purchase->createdDate, 0, 10);
                $purchase->editedDate     = substr($purchase->editedDate, 0, 10);
                $purchase->signedDate     = substr($purchase->signedDate, 0, 10);
                $purchase->deliveredDate  = substr($purchase->deliveredDate, 0, 10);
                $purchase->returnedDate   = substr($purchase->returnedDate, 0, 10);
                $purchase->finishedDate   = substr($purchase->finishedDate, 0, 10);
                $purchase->canceledDate   = substr($purchase->canceledDate, 0, 10);
                $purchase->contactedDate  = substr($purchase->contactedDate, 0, 10);
                $purchase->nextDate       = substr($purchase->contactedDate, 0, 10);

                if($purchase->handlers)
                {
                    $tmpHandlers = array();
                    $handlers = explode(',', $purchase->handlers);
                    foreach($handlers as $handler)
                    {
                        if(!$handler) continue;
                        $handler = trim($handler);
                        $tmpHandlers[] = isset($users[$handler]) ? $users[$handler] : $handler;
                    }

                    $purchase->handlers = join("; \n", $tmpHandlers);
                }

                if(!empty($purchase->order))
                {
                    $tmpOrders = array();
                    foreach($purchase->order as $orderID)
                    {
                        if(!$orderID) continue;
                        $orderID = trim($orderID);
                        $tmpOrders[] = isset($orderPairs[$orderID]) ? $orderPairs[$orderID] : $orderID;
                    }

                    $purchase->order = join("; \n", $tmpOrders);
                }

                /* Set related files. */
                $purchase->files = '';
                if(isset($relatedFiles[$purchase->id]))
                {
                    foreach($relatedFiles[$purchase->id] as $file)
                    {
                        $fileURL = 'http://' . $this->server->http_host . $this->config->webRoot . "data/upload/" . $file->pathname;
                        $purchase->files .= html::a($fileURL, $file->title, '_blank') . '<br />';
                    }
                }
            }

            $this->post->set('fields', $fields);
            $this->post->set('rows', $purchases);
            $this->post->set('kind', 'contract');
            $this->fetch('file', 'export2CSV' , $_POST);
        }

        $this->display();
    }
}
