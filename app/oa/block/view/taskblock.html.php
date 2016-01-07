<?php
/**
 * The task block view file of block module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
?>
<table class='table table-hover table-condensed block-task'>
  <?php foreach($tasks as $id => $task):?>
  <?php
  if(strpos('createdBy,assignedTo,finishedBy', $type) !== false)
  {
      $isParent  = !empty($task->children);
      $isMulti   = !empty($task->team);
      $startDisabled  = (!$isParent and $this->loadModel('task', 'sys')->isClickable($task, 'start')) ? '' : 'disabled';
      $finishDisabled = (!$isParent and $this->task->isClickable($task, 'finish')) ? '' : 'disabled';
      $recordEstimateDisabled = (!$isParent and $this->task->isClickable($task, 'recordEstimate')) ? '' : 'disabled';
  }
  ?>
  <?php $appid = ($this->get->app == 'sys' and isset($_GET['entry'])) ? "class='app-btn' data-id={$this->get->entry}" : ''?>
  <tr <?php echo $appid?>>
    <td class='w-20px text-center'><span class='active pri pri-<?php echo $task->pri;?>'><?php echo $lang->task->priList[$task->pri];?></span></td>
    <td> <?php echo html::a($this->createLink('oa.task', 'view', "taskID=$id"), $task->name);?></td>
    <td class='w-60px'><?php echo $lang->task->statusList[$task->status];?></td>
    <?php if(strpos('createdBy,assignedTo,finishedBy', $type) !== false):?>
    <td class='actions w-50px'>
      <div class='dropdown'>
        <a href='###' data-target='#' data-toggle='dropdown' role='button' id='dLabel'><?php echo $lang->actions;?><span class='caret'></span></a>
        <ul aria-labelledby='dropdownMenu1' role='menu' class='dropdown-menu'>
          <li><?php echo $recordEstimateDisabled ? html::a('###', $lang->task->recordEstimate, "class='disabled'") : html::a($this->createLink('oa.task', 'recordestimate', "taskID=$id"), $lang->task->recordEstimate, "data-toggle='modal'");?></li>
          <?php if(!$isMulti):?>
          <li><?php echo $startDisabled ? html::a('###', $lang->start, "class='disabled'") : html::a($this->createLink('oa.task', 'start', "taskID=$id"), $lang->start, "data-toggle='modal'");?></li>
          <?php endif;?>
          <li><?php echo $finishDisabled ? html::a('###', $lang->finish, "class='disabled'") : html::a($this->createLink('oa.task', 'finish', "taskID=$id"), $lang->finish, "data-toggle='modal'");?></li>
        </ul>
      </div>
    </td>
    <?php endif;?>
  </tr>
  <?php endforeach;?>
</table>
<script>$('.block-task').dataTable();</script>
