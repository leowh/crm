<?php
/**
 * The model file for purchase of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     purchase
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
class purchaseModel extends model
{
    /**
     * Get purchase by ID.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return object.
     */
    public function getByID($purchaseID)
    {
        $purchase = $this->dao->select('*')->from(TABLE_CONTRACT)->where('id')->eq($purchaseID)->fetch();

        if($purchase)
        {
            $purchase->files        = $this->loadModel('file')->getByObject('contract', $purchaseID);
            $purchase->returnList   = $this->getReturnList($purchaseID);
            $purchase->deliveryList = $this->getDeliveryList($purchaseID);
        }

        return $purchase;
    }

    /**
     * Get purchase list.
     * 
     * @param  int    $customer
     * @param  string $orderBy 
     * @param  object $pager 
     * @access public
     * @return array
     */
    public function getList($customer = 0, $mode = 'all', $type = 'purchase', $orderBy = 'id_desc', $pager = null)
    {
        /* process search condition. */
        if($this->session->purchaseQuery == false) $this->session->set('purchaseQuery', ' 1 = 1');
        $purchaseQuery = $this->loadModel('search', 'sys')->replaceDynamic($this->session->purchaseQuery);

        if(strpos($orderBy, 'id') === false) $orderBy .= ', id_desc';
	
        $userList = $this->loadModel('user')->getSubUsers($this->app->user);

        return $this->dao->select('*')->from(TABLE_CONTRACT)
            ->where('deleted')->eq(0)
            ->andWhere('type')->eq($type)
            ->beginIF($userList != '')
            ->andWhere()
            ->markLeft(1)
	    ->where('createdBy')->in($userList)
            ->orWhere('editedBy')->in($userList)
            ->orWhere('signedBy')->in($userList)
            ->orWhere('returnedBy')->in($userList)
            ->orWhere('deliveredBy')->in($userList)
            ->orWhere('finishedBy')->in($userList)
            ->orWhere('canceledBy')->in($userList)
            ->orWhere('contactedBy')->in($userList)
            ->orWhere('handlers')->in($userList)
            ->markRight(1)
            ->fi()
            ->beginIF($mode == 'unfinished')->andWhere('`status`')->eq('normal')->fi()
            ->beginIF($mode == 'unreceived')->andWhere('`return`')->ne('done')->andWhere('`status`')->ne('canceled')->fi()
            ->beginIF($mode == 'undeliveried')->andWhere('`delivery`')->ne('done')->andWhere('`status`')->ne('canceled')->fi()
            ->beginIF($mode == 'canceled')->andWhere('`status`')->eq('canceled')->fi()
            ->beginIF($mode == 'finished')->andWhere('`status`')->eq('closed')->fi()
            ->beginIF($mode == 'expired')->andWhere('`end`')->lt(date(DT_DATE1))->andWhere('`status`')->ne('canceled')->fi()
            ->beginIF($mode == 'returnedBy')->andWhere('returnedBy')->eq($this->app->user->account)->fi()
            ->beginIF($mode == 'deliveredBy')->andWhere('deliveredBy')->eq($this->app->user->account)->fi()
            ->beginIF($mode == 'expire')
            ->andWhere('`end`')->lt(date(DT_DATE1, strtotime('+1 month')))
            ->andWhere('`end`')->gt(date(DT_DATE1))
            ->andWhere('`status`')->ne('canceled')
            ->fi()
            ->beginIF($mode == 'bysearch')->andWhere($purchaseQuery)->fi()
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll('id');
    }

    /**
     * Get purchase pairs.
     * 
     * @param  int    $customerID
     * @access public
     * @return array
     */
    public function getPairs($customerID)
    {

 	$userList = $this->loadModel('user')->getSubUsers($this->app->user);

        return $this->dao->select('*')->from(TABLE_CONTRACT)
            ->where('deleted')->eq(0)
            ->andWhere('type')->eq('purchase')
            ->beginIF($userList != '')
            ->andWhere()
            ->markLeft(1)
            ->where('createdBy')->in($userList)
            ->orWhere('editedBy')->in($userList)
            ->orWhere('signedBy')->in($userList)
            ->orWhere('returnedBy')->in($userList)
            ->orWhere('deliveredBy')->in($userList)
            ->orWhere('finishedBy')->in($userList)
            ->orWhere('canceledBy')->in($userList)
            ->orWhere('contactedBy')->in($userList)
            ->orWhere('handlers')->in($userList)
            ->markRight(1)
            ->fi()
            ->fetchPairs('id','name');
    }

    /**
     * Get return by ID.
     * 
     * @param  int    $returnID 
     * @access public
     * @return object
     */
    public function getReturnByID($returnID)
    {
        return $this->dao->select('*')->from(TABLE_PLAN)->where('id')->eq($returnID)->fetch();
    }

    /**
     * Get returnList of its purchase.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return array
     */
    public function getReturnList($purchaseID, $orderBy = 'id_desc')
    {
        return $this->dao->select('*')->from(TABLE_PLAN)->where('contract')->eq($purchaseID)->orderBy($orderBy)->fetchAll();
    }

    /**
     * Get delivery by ID.
     * 
     * @param  int    $deliveryID 
     * @access public
     * @return object
     */
    public function getDeliveryByID($deliveryID)
    {
        return $this->dao->select('*')->from(TABLE_DELIVERY)->where('id')->eq($deliveryID)->fetch();
    }

    /**
     * Get deliveryList of its purchase.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return array
     */
    public function getDeliveryList($purchaseID, $orderBy = 'id_desc')
    {
        return $this->dao->select('*')->from(TABLE_DELIVERY)->where('contract')->eq($purchaseID)->orderBy($orderBy)->fetchAll();
    }

    /**
     * Create purchase.
     * 
     * @access public
     * @return int|bool
     */
    public function create()
    {
        $now = helper::now();
        $purchase = fixer::input('post')
            ->add('createdBy', $this->app->user->account)
            ->add('createdDate', $now)
            ->add('status', 'normal')
            ->add('delivery', 'wait')
            ->add('return', 'wait')
            ->add('type', 'purchase')
            ->setDefault('order', array())
            ->setDefault('real', array())
            ->setDefault('begin', '0000-00-00')
            ->setDefault('end', '0000-00-00')
            ->setDefault('signedDate', substr($now, 0, 10))
            ->join('handlers', ',')
            ->stripTags('items', $this->config->allowedTags->admin)
            ->get();

        $purchase = $this->loadModel('file')->processEditor($purchase, $this->config->purchase->editor->create['id']);

        $this->dao->insert(TABLE_CONTRACT)->data($purchase, 'order,uid,files,labels,real')
            ->autoCheck()
            ->batchCheck($this->config->purchase->require->create, 'notempty')
            ->checkIF($purchase->end != '0000-00-00', 'end', 'ge', $purchase->begin)
            ->exec();

        $purchaseID = $this->dao->lastInsertID();

        if(!dao::isError())
        {
            /* Update customer info. */
            $customer = new stdclass();
            $customer->status = 'signed';
            $customer->editedDate = helper::now();
            $this->dao->update(TABLE_CUSTOMER)->data($customer)->where('id')->eq($purchase->customer)->exec();
            $this->loadModel('file')->saveUpload('contract', $purchaseID);
            return $purchaseID;
        }

        return false;
    }

    /**
     * Update purchase.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return bool
     */
    public function update($purchaseID)
    {
        $now      = helper::now();
        $purchase = $this->getByID($purchaseID);
        $data     = fixer::input('post')
            ->join('handlers', ',')
            ->add('editedBy', $this->app->user->account)
            ->add('editedDate', $now)
            ->setDefault('order', array())
            ->setDefault('real', array())
            ->setDefault('customer', $purchase->customer)
            ->setDefault('signedDate', '0000-00-00')
            ->setDefault('finishedDate', '0000-00-00')
            ->setDefault('canceledDate', '0000-00-00')
            ->setDefault('deliveredDate', '0000-00-00')
            ->setDefault('returnedDate', '0000-00-00')
            ->setDefault('begin', '0000-00-00')
            ->setDefault('end', '0000-00-00')
            ->setIF($this->post->status == 'normal', 'canceledBy', '')
            ->setIF($this->post->status == 'normal', 'canceledDate', '0000-00-00')
            ->setIF($this->post->status == 'normal', 'finishedBy', '')
            ->setIF($this->post->status == 'normal', 'finishedDate', '0000-00-00')
            ->setIF($this->post->status == 'cancel' and $this->post->canceledBy == '', 'canceledBy', $this->app->user->account)
            ->setIF($this->post->status == 'cancel' and $this->post->canceledDate == '0000-00-00', 'canceledDate', $now)
            ->setIF($this->post->status == 'finished' and $this->post->finishedBy == '', 'finishedBy', $this->app->user->account)
            ->setIF($this->post->status == 'finished' and $this->post->finishedDate == '0000-00-00', 'finishedDate', $now)
            ->remove('files,labels')
            ->stripTags('items', $this->config->allowedTags->admin)
            ->get();

        $data = $this->loadModel('file')->processEditor($data, $this->config->purchase->editor->edit['id']);
        $this->dao->update(TABLE_CONTRACT)->data($data, 'uid,order,real')
            ->where('id')->eq($purchaseID)
            ->autoCheck()
            ->batchCheck($this->config->purchase->require->edit, 'notempty')
            ->checkIF($purchase->end != '0000-00-00', 'end', 'ge', $purchase->begin)
            ->exec();
        
        if(!dao::isError())
        {
            if($purchase->status == 'canceled' and $data->status == 'normal')
            {
                foreach($data->order as $key => $orderID)
                {
                    $order = new stdclass();
                    $order->status     = 'signed';
                    $order->real       = $data->real[$key];
                    $order->signedBy   = $data->signedBy;
                    $order->signedDate = $data->signedDate;

                    $this->dao->update(TABLE_ORDER)->data($order)->where('id')->eq($orderID)->exec();
                    if(dao::isError()) return false;
                }
            }

            if($purchase->status == 'normal' and $data->status == 'canceled')
            {
                foreach($data->order as $orderID)
                {
                    $order = new stdclass();
                    $order->status     = 'normal';
                    $order->real       = 0;
                    $order->signedBy   = '';
                    $order->signedDate = '0000-00-00';

                    $this->dao->update(TABLE_ORDER)->data($order)->where('id')->eq($orderID)->exec();
                    if(dao::isError()) return false;
                }
            }
            
            return commonModel::createChanges($purchase, $data);
        }

        return false;
    }

    /**
     * The delivery of the purchase.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return bool
     */
    public function delivery($purchaseID)
    {
        $now = helper::now();
        $data = fixer::input('post')
            ->add('contract', $purchaseID)
            ->setDefault('deliveredBy', $this->app->user->account)
            ->setDefault('deliveredDate', $now)
            ->stripTags('comment', $this->config->allowedTags->admin)
            ->get();

        $data = $this->loadModel('file')->processEditor($data, $this->config->purchase->editor->delivery['id']);
        $this->dao->insert(TABLE_DELIVERY)->data($data, $skip = 'uid, handlers, finish')->autoCheck()->exec();

        if(!dao::isError())
        {
            $purchase = fixer::input('post')
                ->add('delivery', 'doing')
                ->add('editedBy', $this->app->user->account)
                ->add('editedDate', $now)
                ->setDefault('deliveredBy', $this->app->user->account)
                ->setDefault('deliveredDate', $now)
                ->setIF($this->post->finish, 'delivery', 'done')
                ->join('handlers', ',')
                ->remove('finish')
                ->get();

            $this->dao->update(TABLE_CONTRACT)->data($purchase, $skip = 'uid, comment')
                ->autoCheck()
                ->where('id')->eq($purchaseID)
                ->exec();

            return !dao::isError();
        }

        return false;
    }

    /**
     * Edit delivery of the purchase.
     * 
     * @param  object $delivery 
     * @param  object $purchase 
     * @access public
     * @return bool
     */
    public function editDelivery($delivery, $purchase)
    {
        $now = helper::now();
        $data = fixer::input('post')
            ->add('contract', $purchase->id)
            ->setDefault('deliveredBy', $this->app->user->account)
            ->setDefault('deliveredDate', $now)
            ->stripTags('comment', $this->config->allowedTags->admin)
            ->get();

        $data = $this->loadModel('file')->processEditor($data, $this->config->purchase->editor->editdelivery['id']);
        $this->dao->update(TABLE_DELIVERY)->data($data, $skip = 'uid, handlers, finish')->where('id')->eq($delivery->id)->autoCheck()->exec();

        if(!dao::isError())
        {
            $changes = commonModel::createChanges($delivery, $data);
            if($changes)
            {
                $actionID = $this->loadModel('action')->create('contract', $purchase->id, 'editDelivered');
                $this->action->logHistory($actionID, $changes);
            }

            $deliveryList = $this->getDeliveryList($delivery->purchase, 'deliveredDate_desc');

            $purchaseData = new stdclass();
            $purchaseData->delivery      = 'doing';
            $purchaseData->editedBy      = $this->app->user->account;
            $purchaseData->editedDate    = $now;
            $purchaseData->handlers      = implode(',', $this->post->handlers);
            $purchaseData->deliveredBy   = current($deliveryList)->deliveredBy;
            $purchaseData->deliveredDate = current($deliveryList)->deliveredDate;

            if($this->post->finish) $purchaseData->delivery = 'done';

            $this->dao->update(TABLE_CONTRACT)->data($purchaseData, $skip = 'uid, comment')->where('id')->eq($purchase->id)->exec();

            return !dao::isError();
        }
        return false;
    }

    /**
     * Delete return.
     * 
     * @param  int   $returnID
     * @access public
     * @return bool
     */
    public function deleteDelivery($deliveryID)
    {
        $delivery = $this->getDeliveryByID($deliveryID);

        $this->dao->delete()->from(TABLE_DELIVERY)->where('id')->eq($deliveryID)->exec();

        $deliveryList = $this->getDeliveryList($delivery->contract, 'deliveredDate_desc');
        $purchase = new stdclass();
        if(empty($deliveryList))
        {
            $purchase->delivery      = 'wait';
            $purchase->deliveredBy   = '';
            $purchase->deliveredDate = '0000-00-00';
        }
        else
        {
            $purchase->delivery       = 'doing';
            $purchase->deliveredBy   = current($deliveryList)->deliveredBy;
            $purchase->deliveredDate = current($deliveryList)->deliveredDate;
        }

        $this->dao->update(TABLE_CONTRACT)->data($purchase)->where('id')->eq($delivery->contract)->autoCheck()->exec();

        return !dao::isError();
    }

    /**
     * Receive payments of the purchase.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return bool
     */
    public function receive($purchaseID)
    {
        $purchase = $this->getByID($purchaseID);

        $now = helper::now();
        $data = fixer::input('post')
            ->add('contract', $purchaseID)
            ->setDefault('returnedBy', $this->app->user->account)
            ->setDefault('returnedDate', $now)
            ->remove('finish,handlers,depositor,category')
            ->get();
        
	$this->dao->insert(TABLE_PLAN)
            ->data($data, $skip = 'uid, comment, depositor')
            ->autoCheck()
            ->batchCheck($this->config->purchase->require->receive, 'notempty')
            ->exec();

        if(!dao::isError())
        {
            $purchaseData = new stdclass();
            $purchaseData->return       = 'doing';
            $purchaseData->editedBy     = $this->app->user->account;
            $purchaseData->editedDate   = $now;
            $purchaseData->handlers     = implode(',', $this->post->handlers);
            $purchaseData->returnedBy   = $this->post->returnedBy ? $this->post->returnedBy : $this->app->user->account;
            $purchaseData->returnedDate = $this->post->returnedDate ? $this->post->returnedDate : $now;
            if($this->post->finish) $purchaseData->return = 'done';

            $this->dao->update(TABLE_CONTRACT)->data($purchaseData, $skip = 'uid, comment')->where('id')->eq($purchaseID)->exec();

            if(!dao::isError() and $this->post->finish) $this->dao->update(TABLE_CUSTOMER)->set('status')->eq('payed')->where('id')->eq($purchase->customer)->exec();

	    $ret = $this->loadModel('trade','cash')->createReceive('out',$purchaseID);

            return !dao::isError();
        }
	
        return false;
    }

    /**
     * Edit return.
     * 
     * @param  object    $return 
     * @access public
     * @return bool
     */
    public function editReturn($return, $purchase)
    {
        $now = helper::now();
        $data = fixer::input('post')
            ->add('contract', $purchase->id)
            ->setDefault('returnedBy', $this->app->user->account)
            ->setDefault('returnedDate', $now)
            ->remove('finish,handlers')
            ->get();

        $this->dao->update(TABLE_PLAN)
            ->data($data, $skip = 'uid, comment')
            ->where('id')->eq($return->id)
            ->autoCheck()
            ->batchCheck($this->config->purchase->require->receive, 'notempty')
            ->exec();

        if(!dao::isError())
        {
            $changes = commonModel::createChanges($return, $data);
            if($changes)
            {
                $actionID = $this->loadModel('action')->create('contract', $purchase->id, 'editReturned');
                $this->action->logHistory($actionID, $changes);
            }

            $returnList = $this->getReturnList($return->contract, 'returnedDate_desc');

            $purchaseData = new stdclass();
            $purchaseData->return       = 'doing';
            $purchaseData->editedBy     = $this->app->user->account;
            $purchaseData->editedDate   = $now;
            $purchaseData->handlers     = implode(',', $this->post->handlers);
            $purchaseData->returnedBy   = current($returnList)->returnedBy;
            $purchaseData->returnedDate = current($returnList)->returnedDate;

            if($this->post->finish) $purchaseData->return = 'done';

            $this->dao->update(TABLE_CONTRACT)->data($purchaseData, $skip = 'uid, comment')->where('id')->eq($purchase->id)->exec();

            if(!dao::isError() and $this->post->finish) $this->dao->update(TABLE_CUSTOMER)->set('status')->eq('payed')->where('id')->eq($purchase->customer)->exec();

            return !dao::isError();
        }

        return false;
    }

    /**
     * Delete return.
     * 
     * @param  int   $returnID
     * @access public
     * @return bool
     */
    public function deleteReturn($returnID)
    {
        $return = $this->getReturnByID($returnID);

        $this->dao->delete()->from(TABLE_PLAN)->where('id')->eq($returnID)->exec();

        $returnList = $this->getReturnList($return->contract, 'returnedDate_desc');
        $purchase = new stdclass();
        if(empty($returnList))
        {
            $purchase->return       = 'wait';
            $purchase->returnedBy   = '';
            $purchase->returnedDate = '0000-00-00';
        }
        else
        {
            $purchase->return       = 'doing';
            $purchase->returnedBy   = current($returnList)->returnedBy;
            $purchase->returnedDate = current($returnList)->returnedDate;
        }

        $this->dao->update(TABLE_CONTRACT)->data($purchase)->where('id')->eq($return->contract)->autoCheck()->exec();

        return !dao::isError();
    }

    /**
     * Cancel purchase.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return bool
     */
    public function cancel($purchaseID)
    {
        $purchase = new stdclass();
        $purchase->status       = 'canceled';
        $purchase->canceledBy   = $this->app->user->account;
        $purchase->canceledDate = helper::now();
        $purchase->editedBy     = $this->app->user->account;
        $purchase->editedDate   = helper::now();

        $this->dao->update(TABLE_CONTRACT)->data($purchase, $skip = 'uid, comment')
            ->autoCheck()
            ->where('id')->eq($purchaseID)
            ->exec();

        if(!dao::isError()) 
        {
            $purchase = $this->getByID($purchaseID);
            if($purchase->order)
            {
                foreach($purchase->order as $orderID)
                {
                    $order = new stdclass(); 
                    $order->status     = 'normal';
                    $order->signedDate = '0000-00-00';
                    $order->real       = 0;
                    $order->signedBy   = '';

                    $this->dao->update(TABLE_ORDER)->data($order)->autoCheck()->where('id')->eq($orderID)->exec();
                }
                return !dao::isError();
            }
            return true;
        }
        return false;
    }

    /**
     * Finish purchase.
     * 
     * @param  int    $purchaseID 
     * @access public
     * @return bool
     */
    public function finish($purchaseID)
    {
        $purchase = new stdclass();
        $purchase->status       = 'closed';
        $purchase->finishedBy   = $this->app->user->account;
        $purchase->finishedDate = helper::now();
        $purchase->editedBy     = $this->app->user->account;
        $purchase->editedDate   = helper::now();

        $this->dao->update(TABLE_CONTRACT)->data($purchase, $skip = 'uid, comment')
            ->autoCheck()
            ->where('id')->eq($purchaseID)
            ->exec();

        return !dao::isError();
    }

    /**
     * Build operate menu.
     * 
     * @param  object $purchase 
     * @param  string $class 
     * @param  string $type 
     * @access public
     * @return string
     */
    public function buildOperateMenu($purchase, $class = '', $type = 'browse')
    {
        $menu  = '';

        $canCreateRecord = commonModel::hasPriv('action', 'createRecord');
        $canReceive      = commonModel::hasPriv('contract', 'receive');
        $canDelivery     = commonModel::hasPriv('contract', 'delivery');
        $canFinish       = commonModel::hasPriv('contract', 'finish');
        $canEdit         = commonModel::hasPriv('contract', 'edit');
        $canCancel       = commonModel::hasPriv('contract', 'cancel');
        $canDelete       = commonModel::hasPriv('contract', 'delete');

        if($type == 'view') $menu .= "<div class='btn-group'>";

        if($canCreateRecord) $menu .= html::a(helper::createLink('action', 'createRecord', "objectType=purchase&objectID={$purchase->id}&customer={$purchase->customer}"), $this->lang->purchase->record, "class='$class' data-toggle='modal' data-type='iframe'");

        if($purchase->return != 'done' and $purchase->status == 'normal' and $canReceive)
        {
            $menu .= html::a(helper::createLink('cash.purchase', 'receive',  "purchase=$purchase->id"), $this->lang->purchase->return, "data-toggle='modal' class='$class'");
        }
        else
        {
            $menu .= "<a href='###' disabled='disabled' class='disabled  $class'>" . $this->lang->purchase->return . '</a> ';
        }

        if($purchase->delivery != 'done' and $purchase->status == 'normal' and $canDelivery)
        {
            $menu .= html::a(helper::createLink('cash.purchase', 'delivery', "purchase=$purchase->id"), $this->lang->purchase->delivery, "data-toggle='modal' class='$class'");
        }
        else
        {
            $menu .= "<a href='###' disabled='disabled' class='disabled $class'>" . $this->lang->purchase->delivery . '</a> ';
        }

        if($type == 'view') $menu .= "</div><div class='btn-group'>";

        if($purchase->status == 'normal' and $purchase->return == 'done' and $purchase->delivery == 'done' and $canFinish)
        {
            $menu .= html::a(helper::createLink('cash.purchase', 'finish', "purchase=$purchase->id"), $this->lang->finish, "data-toggle='modal' class='$class'");
        }
        else
        {
            $menu .= "<a href='###' disabled='disabled' class='disabled $class'>" . $this->lang->finish . '</a> ';
        }

        if($canEdit) $menu .= html::a(helper::createLink('cash.purchase', 'edit', "purchase=$purchase->id"), $this->lang->edit, "class='$class'");

        if($type == 'view')
        {
            $menu .= "</div><div class='btn-group'>";
            if($purchase->status == 'normal' and !($purchase->return == 'done' and $purchase->delivery == 'done') and $canCancel)
            {
                $menu .= html::a(helper::createLink('cash.purchase', 'cancel', "purchase=$purchase->id"), $this->lang->cancel, "data-toggle='modal' class='$class'");
            }
            else
            {
                $menu .= "<a href='###' disabled='disabled' class='disabled $class'>" . $this->lang->cancel . '</a> ';
            }

            if($purchase->status == 'canceled' or ($purchase->status == 'normal' and !($purchase->return == 'done' and $purchase->delivery == 'done')) and $canDelete)
            {
                $menu .= html::a(helper::createLink('cash.purchase', 'delete', "purchase=$purchase->id"), $this->lang->delete, "class='deleter $class'");
            }
            else
            {
                $menu .= "<a href='###' disabled='disabled' class='disabled $class'>" . $this->lang->delete . '</a> ';
            }
        }

        if($type == 'browse')
        {
            $menu .="<div class='dropdown'><a data-toggle='dropdown' href='javascript:;'>" . $this->lang->more . "<span class='caret'></span> </a><ul class='dropdown-menu pull-right'>";

            if($purchase->status == 'normal' and !($purchase->return == 'done' and $purchase->delivery == 'done') and $canCancel)
            {
                $menu .= "<li>" . html::a(helper::createLink('cash.purchase', 'cancel', "purchase=$purchase->id"), $this->lang->cancel, "data-toggle='modal' class='$class'") . "</li>";
            }
            else
            {
                $menu .= "<li><a href='###' disabled='disabled' class='disabled $class'>" . $this->lang->cancel . '</a></li> ';
            }

            if($purchase->status == 'canceled' or ($purchase->status == 'normal' and !($purchase->return == 'done' and $purchase->delivery == 'done')) and $canDelete)
            {
                $menu .= "<li>" . html::a(helper::createLink('cash.purchase', 'delete', "purchase=$purchase->id"), $this->lang->delete, "class='reloadDeleter $class'") . "</li>";
            }
            else
            {
                $menu .= "<li><a href='###' disabled='disabled' class='disabled $class'>" . $this->lang->delete . '</a></li> ';
            }
            $menu .= '</ul>';
        }

        $menu .= "</div>";

        return $menu;
    }

    /**
     * Count amount.
     * 
     * @param  array  $purchases 
     * @access public
     * @return array
     */
    public function countAmount($purchases)
    {
        $totalAmount  = array();
        $currencyList = $this->loadModel('common', 'sys')->getCurrencyList();
        $currencySign = $this->common->getCurrencySign();
        $totalReturn  = $this->dao->select('*')->from(TABLE_PLAN)->fetchGroup('contract');

        foreach($purchases as $purchase)
        {
            if($purchase->status == 'canceled') continue;
            foreach($currencyList as $key => $currency)
            {
                if($purchase->currency == $key)
                {
                    if(!isset($totalAmount['purchase'][$key])) $totalAmount['purchase'][$key] = 0;
                    if(!isset($totalAmount['return'][$key]))   $totalAmount['return'][$key] = 0;

                    $totalAmount['purchase'][$key] += $purchase->amount;
                    
                    if(isset($totalReturn[$purchase->id])) foreach($totalReturn[$purchase->id] as $return) $totalAmount['return'][$key] += $return->amount;
                }
            }
        }

        foreach($totalAmount as $type => $currencyAmount) foreach($currencyAmount as $currency => $amount) $totalAmount[$type][$currency] = "<span title='$amount'>" . $currencySign[$currency] . commonModel::tidyMoney($amount) . "</span>";

        return $totalAmount;
    }
}
