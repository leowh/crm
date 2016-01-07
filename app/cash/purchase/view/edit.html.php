<?php
/**
 * The edit view file of purchase module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     purchase
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../../sys/common/view/kindeditor.html.php';?>
<?php include '../../../sys/common/view/chosen.html.php';?>
<ul id='menuTitle'>
  <li><?php commonModel::printLink('purchase', 'browse', '', $lang->purchase->list);?></li>
  <li class='divider angle'></li>
  <li><?php commonModel::printLink('purchase', 'view', "purchaseID={$purchase->id}", $lang->purchase->view);?></li>
  <li class='divider angle'></li>
  <li class='title'><?php echo "ddfaf" ;echo $lang->purchase->edit?></li>
</ul>
<form method='post' id='ajaxForm'>
<div class='row-table'>
  <div class='col-main'>
    <div class='panel'>
      <div class='panel-body'>
        <table class='table table-form'>
          <tr>
            <th class='w-80px'><?php echo $lang->purchase->name;?></th>
            <td colspan='2'><?php echo html::input('name', $purchase->name, "class='form-control'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->code;?></th>
            <td colspan='2'><?php echo html::input('code', $purchase->code, "class='form-control'");?></td>
          </tr>
          <?php foreach($purchaseOrders as $currentOrder):?>
          <tr>
            <th class='orderTH'><?php echo $lang->purchase->order;?></th>
            <td colspan='2'>
              <div class='form-group'>
                <span class='col-sm-7'>
                  <select name='order[]' class='select-order form-control'>
                    <?php foreach($orders as $order):?>
                    <?php if(!$order):?>
                    <option value='' data-real='' data-currency=''></option>
                    <?php else:?>
                    <?php if($order->id == $currentOrder->id or $order->status == 'normal'):?>
                    <?php $selected = $currentOrder->id == $order->id ? "selected='selected'" : '';?>
                    <option value="<?php echo $order->id;?>" <?php echo $selected;?> data-real="<?php echo $order->plan;?>" data-currency="<?php echo $order->currency?>"><?php echo $order->title;?></option>
                    <?php endif;?>
                    <?php endif;?>
                    <?php endforeach;?>
                  </select>
                </span>
                <span class='col-sm-4'>
                  <div class='input-group'>
                    <div class='input-group-addon order-currency'>
                      <?php echo zget($currencySign, $currentOrder->currency, '');?> 
                    </div>
                    <?php echo html::input('real[]', ($currentOrder->real and $currentOrder->real != '0.00') ? $currentOrder->real : $currentOrder->plan, "class='order-real form-control' placeholder='{$this->lang->purchase->placeholder->real}'");?>
                  </div>
                </span>
                <span class='col-sm-1' style='margin-top: 8px;'><?php echo html::a('javascript:;', "<i class='icon-plus'></i>", "class='plus'") . html::a('javascript:;', "<i class='icon-remove'></i>", "class='minus'");?></span>
              </div>
            </td>
          </tr>
          <?php endforeach;?>
          <tbody id='tmpData' class='hide'></tbody>
          <tr>
            <th><?php echo $lang->purchase->amount;?></th>
            <td>
              <div class='row'>
                <div class='col-sm-2'><?php echo html::select('currency', $currencyList, $purchase->currency, "class='form-control'");?></div>
                <div class='col-sm-10'><?php echo html::input('amount', $purchase->amount, "class='form-control'");?></div>
              </div>
            </td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->items;?></th>
            <td colspan='2'><?php echo html::textarea('items', $purchase->items, "class='form-control'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->files;?></th>
            <td colspan='2'><?php echo $this->fetch('file', 'buildForm');?></td>
          </tr>
        </table>
      </div>
    </div>
    <?php echo $this->fetch('action', 'history', "objectType=purchase&objectID={$purchase->id}")?>
    <div class='page-actions'><?php echo html::submitButton() . html::backButton();?></div>
  </div>
  <div class='col-side'>
    <div class='panel'>
      <div class='panel-heading'>
        <strong><?php echo $lang->basicInfo;?></strong>
      </div>
      <div class='panel-body'>
        <table class='table table-form'>
          <tr>
            <th class='w-70px'><?php echo $lang->purchase->customer;?></th>
            <td><?php echo html::select('customer', $customers, $purchase->customer, "class='form-control' disabled");?></td><td></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->delivery;?></th>
            <td><?php echo html::select('delivery', $lang->purchase->deliveryList, $purchase->delivery, "class='form-control'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->return;?></th>
            <td><?php echo html::select('return', $lang->purchase->returnList, $purchase->return, "class='form-control'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->status;?></th>
            <td><?php echo html::select('status', $lang->purchase->statusList, $purchase->status, "class='form-control'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->contact;?></th>
            <td><?php echo html::select('contact', $contacts, $purchase->contact, "class='form-control chosen'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->begin;?></th>
            <td><?php echo html::input('begin', $purchase->begin, "class='form-control form-date'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->end;?></th>
            <td><?php echo html::input('end', $purchase->end, "class='form-control form-date'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->handlers;?></th>
            <td><?php echo html::select('handlers[]', $users, $purchase->handlers, "class='form-control chosen' multiple");?></td>
          </tr>
        </table>
      </div>
    </div>
    <div class='panel'>
      <div class='panel-heading'>
        <strong><?php echo $lang->purchase->lifetime;?></strong>
      </div>
      <div class='panel-body'>
        <table class='table table-form table-data' id='purchaseLife'>
          <tr>
            <th class='w-70px'><?php echo $lang->purchase->createdBy;?></th>
            <td><?php echo zget($users, $purchase->createdBy);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->signedBy;?></th>
            <td><?php echo html::select('signedBy', $users, $purchase->signedBy, "class='form-control chosen'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->signedDate;?></th>
            <td><?php echo html::input('signedDate', $purchase->signedDate, "class='form-control form-date'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->deliveredBy;?></th>
            <td><?php echo html::select('deliveredBy', $users, $purchase->deliveredBy, "class='form-control chosen'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->deliveredDate;?></th>
            <td><?php echo html::input('deliveredDate', $purchase->deliveredDate, "class='form-control form-date'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->returnedBy;?></th>
            <td><?php echo html::select('returnedBy', $users, $purchase->returnedBy, "class='form-control chosen'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->returnedDate;?></th>
            <td><?php echo html::input('returnedDate', $purchase->returnedDate, "class='form-control form-date'");?></td>
          </tr>
          <?php if($purchase->finishedBy):?>
          <tr>
            <th><?php echo $lang->purchase->finishedBy;?></th>
            <td><?php echo html::select('finishedBy', $users, $purchase->finishedBy, "class='form-control chosen'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->finishedDate;?></th>
            <td><?php echo html::input('finishedDate', $purchase->finishedDate, "class='form-control form-date'");?></td>
          </tr>
          <?php endif;?>
          <?php if($purchase->canceledBy):?>
          <tr>
            <th><?php echo $lang->purchase->canceledBy;?></th>
            <td><?php echo html::select('canceledBy', $users, $purchase->canceledBy, "class='form-control chosen'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->canceledDate;?></th>
            <td><?php echo html::input('canceledDate', $purchase->canceledDate, "class='form-control form-date'");?></td>
          </tr>
          <?php endif;?>
        </table>
      </div>
    </div>
  </div>
</div>
</form>
<table id='orderGroup' class='hide'>
  <tr>
    <th></th>
    <td colspan='2'>
      <div class='form-group'>
        <span class='col-sm-7'>
          <select name='order[]' class='select-order form-control'>
            <?php foreach($orders as $order):?>
            <?php if(!$order):?>
            <option value='' data-real='' data-currency=''></option>
            <?php else:?>
            <option value="<?php echo $order->id;?>" data-real="<?php echo $order->plan;?>" data-currency="<?php echo $order->currency?>"><?php echo $order->title;?></option>
            <?php endif;?>
            <?php endforeach;?>
          </select>
        </span>
        <span class='col-sm-4'>
          <div class='input-group'>
            <div class='input-group-addon order-currency'><?php echo zget($currencySign, $purchase->currency, $purchase->currency)?></div>
            <?php echo html::input('real[]', '', "class='order-real form-control' placeholder='{$this->lang->purchase->placeholder->real}'");?>
          </div>
        </span>
        <span class='col-sm-1' style='margin-top: 8px;'><?php echo html::a('javascript:;', "<i class='icon-plus'></i>", "class='plus'") . html::a('javascript:;', "<i class='icon-remove'></i>", "class='minus'");?></span>
      </div>
    </td>
  </tr>
</table>
<?php js::set('currencySign', array('' => '') + $currencySign);?>
<?php include '../../common/view/footer.html.php';?>
