<?php
/**
 * The view view file of purchase module of RanZhi.
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
<ul id='menuTitle'>
  <li><?php commonModel::printLink('purchase', 'browse', '', $lang->purchase->list);?></li>
  <li class='divider angle'></li>
  <li class='title'><?php echo $purchase->name;?></li>
</ul>
<div class="row-table">
  <div class='col-main'>
    <div class='panel'>
      <div class='panel-heading'><strong><?php echo $lang->purchase->items;?></strong></div>
      <div class='panel-body'>
        <?php echo $purchase->items;?>
        <div><?php echo $this->fetch('file', 'printFiles', array('files' => $purchase->files, 'fieldset' => 'false'))?></div>
      </div>
    </div>
    <?php echo $this->fetch('action', 'history', "objectType=purchase&objectID={$purchase->id}")?>
    <div class='page-actions'>
      <?php
      echo $this->purchase->buildOperateMenu($purchase, 'btn', 'view');

      $browseLink = $this->session->purchaseList ? $this->session->purchaseList : inlink('browse');
      commonModel::printRPN($browseLink, $preAndNext);
      ?>
    </div>
  </div>
  <div class='col-side'>
    <div class='panel'>
      <div class='panel-heading'>
        <strong><?php echo $lang->basicInfo;?></strong>
      </div>
      <div class='panel-body'>
        <table class='table table-info'>
          <tr>
            <th class='w-80px'><?php echo $lang->purchase->code;?></th>
            <td><?php echo $purchase->code;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->purchase->customer;?></th>
            <td><?php echo html::a($this->createLink('customer', 'view', "customerID={$purchase->customer}"), zget($customers, $purchase->customer));?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->order;?></th>
            <td>
              <?php foreach($orders as $order):?>
              <div><?php echo html::a($this->createLink('order', 'view', "orderID={$order->id}"), $order->title);?></div>
              <?php endforeach;?>
            </td>
          </tr>
          <?php if(!empty($orders)):?>
          <tr>
            <th><?php echo $lang->order->product;?></th>
            <td>
              <?php foreach($orders as $order):?>
                <?php foreach($order->products as $product):?>
                <span><?php echo $product?> </span>
                <?php endforeach;?>
              <?php endforeach;?>
            </td>
          </tr>
          <?php endif;?>
          <tr>
            <th><?php echo $lang->purchase->amount;?></th>
            <td><?php echo zget($currencySign, $purchase->currency, '') . formatMoney($purchase->amount);?></td>
          </tr>
          <tr>
            <th class='w-70px'><?php echo $lang->purchase->delivery;?></th>
            <td><?php echo $lang->purchase->deliveryList[$purchase->delivery];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->return;?></th>
            <td><?php echo $lang->purchase->returnList[$purchase->return];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->status;?></th>
            <td><?php echo $lang->purchase->statusList[$purchase->status];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->contact;?></th>
            <td><?php if(isset($contacts[$purchase->contact]) and trim($contacts[$purchase->contact]) != "") echo html::a($this->createLink('contact', 'view', "contactID={$purchase->contact}"), $contacts[$purchase->contact]);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->begin;?></th>
            <td><?php echo $purchase->begin;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->end;?></th>
            <td><?php echo $purchase->end;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->handlers;?></th>
            <td>
              <?php
              foreach(explode(',', $purchase->handlers) as $handler)
              {
                  if($handler and isset($users[$handler])) echo $users[$handler] . ' ';
              }
              ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <?php if(!empty($purchase->returnList)):?>
    <div class='panel'>
      <div class='panel-heading'>
        <div class='row'>      
          <div class='col-sm-3'><strong><i class="icon-list-info"></i> <?php echo $lang->purchase->returnedDate;?></strong></div>
          <div class='col-sm-4'><strong><?php echo $lang->purchase->returnedBy;?></strong></div> 
          <div class='col-sm-3'><strong><?php echo $lang->purchase->amount;?></strong></div> 
        </div>
      </div>
      <table class='table table-data table-condensed'>
        <?php foreach($purchase->returnList as $return):?>
        <tr>
          <td class='w-p30'><?php echo $return->returnedDate;?></td>
          <td class='w-p30'><?php echo zget($users, $return->returnedBy, $return->returnedBy);?></td>
          <td class='w-p20'><?php echo zget($currencySign, $purchase->currency, '') . formatMoney($return->amount);?></td>
          <td class='w-p20'>
            <?php commonModel::printLink('purchase', 'editReturn', "id=$return->id", $lang->edit, "data-toggle='modal'");?>
            <?php commonModel::printLink('purchase', 'deleteReturn', "id=$return->id", $lang->delete, "class='deleter'");?>
         </td>
        </tr>
        <?php endforeach;?>
      </table>
    </div>
    <?php endif;?>
    <?php if(!empty($purchase->deliveryList)):?>
    <div class='panel'>
      <div class='panel-heading'>
        <div class='row'>      
          <div class='col-sm-3'><strong><i class="icon-list-info"></i> <?php echo $lang->purchase->deliveredDate;?></strong></div>
          <div class='col-sm-3'><strong><?php echo $lang->purchase->deliveredBy;?></strong></div> 
          <div class='col-sm-6'><strong><?php echo $lang->comment;?></strong></div> 
        </div>
      </div>
      <table class='table table-data table-condensed'>
        <?php foreach($purchase->deliveryList as $delivery):?>
        <tr>
          <td class='w-p25'><?php echo $delivery->deliveredDate;?></td>
          <td class='w-p20'><?php echo zget($users, $delivery->deliveredBy, $delivery->deliveredBy);?></td>
          <td class='w-p35'><?php echo $delivery->comment;?></td>
          <td class='w-p20'>
            <?php commonModel::printLink('purchase', 'editDelivery', "id=$delivery->id", $lang->edit, "data-toggle='modal'");?>
            <?php commonModel::printLink('purchase', 'deleteDelivery', "id=$delivery->id", $lang->delete, "class='deleter'");?>
         </td>
        </tr>
        <?php endforeach;?>
      </table>
    </div>
    <?php endif;?>
    <div class='panel'>
      <div class='panel-heading'>
        <strong><?php echo $lang->purchase->lifetime;?></strong>
      </div>
      <div class='panel-body'>
        <table class='table table-info' id='purchaseLife'>
          <tr>
            <th class='w-70px'><?php echo $lang->purchase->createdBy;?></th>
            <td><?php echo zget($users, $purchase->createdBy, $purchase->createdBy) . $lang->at . $purchase->createdDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->signedBy;?></th>
            <td><?php if($purchase->signedBy) echo zget($users, $purchase->signedBy, $purchase->signedBy) . $lang->at . $purchase->signedDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->deliveredBy;?></th>
            <td><?php if($purchase->deliveredBy) echo zget($users, $purchase->deliveredBy, $purchase->deliveredBy) . $lang->at . $purchase->deliveredDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->returnedBy;?></th>
            <td><?php if($purchase->returnedBy) echo zget($users, $purchase->returnedBy, $purchase->returnedBy) . $lang->at . $purchase->returnedDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->finishedBy;?></th>
            <td><?php if($purchase->finishedBy) echo zget($users, $purchase->finishedBy, $purchase->finishedBy) . $lang->at . $purchase->finishedDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->canceledBy;?></th>
            <td><?php if($purchase->canceledBy) echo zget($users, $purchase->canceledBy, $purchase->canceledBy) . $lang->at . $purchase->canceledDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->purchase->editedBy;?></th>
            <td><?php if($purchase->editedBy) echo zget($users, $purchase->editedBy, $purchase->editedBy) . $lang->at . $purchase->editedDate;?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
