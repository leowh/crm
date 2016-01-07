<?php 
/**
 * The receive payments file of purchase module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     purchase 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
?>
<?php include '../../../sys/common/view/header.modal.html.php';?>
<?php include '../../../sys/common/view/kindeditor.html.php';?>
<?php include '../../../sys/common/view/chosen.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<form method='post' id='ajaxForm' class='form-inline' action='<?php echo $this->createLink('purchase', 'receive', "purchaseID={$purchase->id}")?>'>
  <table class='table table-form table-condensed'>
    <tr>
      <th><?php echo $lang->purchase->all;?></th>
      <td><?php echo zget($currencySign, $purchase->currency, $purchase->currency) . $purchase->amount;?></td>
    </tr>
    <tr>
      <th class='w-80px'><?php echo $lang->purchase->thisAmount;?></th>
      <td class='w-p40'>
        <div class='input-group'>
          <?php echo html::input('amount', '', "class='form-control'");?>
          <div class='input-group-addon'>
            <label class='checkbox'><input type='checkbox' id='finish' name='finish' value='1'> <?php echo $lang->purchase->completeReturn;?></label>
          </div>
        </div>
      </td><td></td>
    </tr>

    <tr>
          <th class='w-100px'><?php echo $lang->trade->depositor;?></th>
          <td><?php echo html::select('depositor', $depositorList, '', "class='form-control'");?></td>
    </tr>

    <tr class='expense'>
          <th><?php echo $lang->trade->category;?></th>
          <td>
            <div class='input-group'>
              <?php echo html::select('category', array('') + (array) $categories, '', "class='form-control'");?>
            </div>
          </td>
    </tr>

    <tr>
      <th><?php echo $lang->purchase->returnedBy;?></th>
      <td><?php echo html::select('returnedBy', $users, $this->app->user->account, "class='form-control chosen'");?></td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->purchase->returnedDate;?></th>
      <td><?php echo html::input('returnedDate', '', "class='form-control form-date'");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->purchase->handlers;?></th>
      <td colspan='2'><?php echo html::select('handlers[]', $users, $this->app->user->account, "class='form-control chosen' multiple");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->comment;?></th>
      <td colspan='2'><?php echo html::textarea('comment', '', "rows='2'");?></td>
    </tr>
    <tr>
      <th></th>
      <td><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php if(!empty($purchase->returnList)):?>
<div class='panel'>
  <div class='panel-heading'><strong><?php echo $lang->purchase->returnRecords;?></strong></div>
  <div class='panel-body'>
    <?php foreach($purchase->returnList as $return):?>
    <?php printf($lang->purchase->returnInfo, $return->returnedDate, zget($users, $return->returnedBy, $return->returnedBy), zget($currencySign, $purchase->currency, '') . $return->amount);?>
    <?php endforeach;?>
  </div>
</div>
<?php endif;?>
<?php include '../../../sys/common/view/footer.modal.html.php';?>
