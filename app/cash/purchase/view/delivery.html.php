<?php 
/**
 * The delivery file of purchase module of RanZhi.
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
<form method='post' id='ajaxForm' action='<?php echo inlink('delivery', "purchaseID=$purchaseID")?>'>
  <table class='table table-form'>
    <tr>
      <th class='w-80px'><?php echo $lang->purchase->deliveredBy;?></th>
      <td class='w-p40'>
        <div class='input-group'>
          <?php echo html::select('deliveredBy', $users, $this->app->user->account, "class='form-control chosen'");?>
          <div class='input-group-addon'>
            <label class='checkbox'><input type='checkbox' id='finish' name='finish' value='1'> <?php echo $lang->purchase->completeDelivery;?></label>
          </div>
        </div>
      </td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->purchase->deliveredDate;?></th>
      <td><?php echo html::input('deliveredDate', '', "class='form-control form-date'");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->purchase->handlers;?></th>
      <td colspan='2'><?php echo html::select('handlers[]', $users, $this->app->user->account, "class='form-control chosen' multiple");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->comment;?></th>
      <td colspan='2'><?php echo html::textarea('comment');?></td>
    </tr>
    <tr>
      <th></th>
      <td><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php include '../../../sys/common/view/footer.modal.html.php';?>
