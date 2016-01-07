<?php
/**
 * The zh-tw file of my module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     my 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
$lang->my = new stdclass();
$lang->my->common = '我的地盤';

$lang->my->review = new stdclass();
$lang->my->review->menu = new stdclass();
$lang->my->review->menu->attend = '考勤|my|review|type=attend';
$lang->my->review->menu->leave  = '請假|my|review|type=leave';
$lang->my->review->menu->refund = '報銷|my|review|type=refund';

$lang->my->order = new stdclass();
$lang->my->order->common = '任務';

$lang->my->order->menu = new stdclass();
$lang->my->order->menu->past       = '亟需聯繫|my|order|type=past';
$lang->my->order->menu->today      = '今天聯繫|my|order|type=today';
$lang->my->order->menu->tomorrow   = '明天聯繫|my|order|type=tomorrow';
$lang->my->order->menu->assignedTo = '指派給我|my|order|type=assignedTo';
$lang->my->order->menu->createdBy  = '由我創建|my|order|type=createdBy';
$lang->my->order->menu->signedBy   = '由我簽約|my|order|type=signedBy';
$lang->my->order->menu->all        = '所有|my|order|type=all';

$lang->my->contract = new stdclass();
$lang->my->contract->common = '合同';

$lang->my->contract->menu = new stdclass();
$lang->my->contract->menu->unfinished  = '未完成|my|contract|type=unfinished';
$lang->my->contract->menu->finished    = '已完成|my|contract|type=finished';
$lang->my->contract->menu->canceled    = '已取消|my|contract|type=canceled';
$lang->my->contract->menu->returnedBy  = '由我回款|my|contract|type=returnedBy';
$lang->my->contract->menu->deliveredBy = '由我交付|my|contract|type=deliveredBy';

$lang->my->company = new stdclass();
$lang->my->company->common  = '待辦';
$lang->my->company->dept    = '部門';
$lang->my->company->all     = '所有';
$lang->my->company->account = '用戶';
$lang->my->company->begin   = '開始';
$lang->my->company->end     = '結束';
$lang->my->company->view    = '查看';

$lang->my->task = new stdclass();
$lang->my->task->common     = '我的任務';
$lang->my->task->assignedTo = '指派給我';
$lang->my->task->createdBy  = '由我創建';
$lang->my->task->finishedBy = '由我完成';
$lang->my->task->closedBy   = '由我關閉';
$lang->my->task->canceledBy = '由我取消';

$lang->my->task->menu = new stdclass();
$lang->my->task->menu->assignedToMe = '指派給我|my|task|type=assignedTo';
$lang->my->task->menu->createdByMe  = '由我創建|my|task|type=createdBy';
$lang->my->task->menu->finishedByMe = '由我完成|my|task|type=finishedBy';
$lang->my->task->menu->closedByMe   = '由我關閉|my|task|type=closedBy';
$lang->my->task->menu->canceledByMe = '由我取消|my|task|type=canceledBy';

$lang->my->project = new stdclass();
$lang->my->project->common = '我的項目';

$lang->my->dynamic = new stdclass();
$lang->my->dynamic->common = '我的動態';

$lang->my->dynamic->menu = new stdclass();
$lang->my->dynamic->menu->today      = '今天|my|dynamic|period=today';
$lang->my->dynamic->menu->yesterday  = '昨天|my|dynamic|period=yesterday';
$lang->my->dynamic->menu->twodaysago = '前天|my|dynamic|period=twodaysago';
$lang->my->dynamic->menu->thisweek   = '本週|my|dynamic|period=thisweek';
$lang->my->dynamic->menu->lastweek   = '上周|my|dynamic|period=lastweek';
$lang->my->dynamic->menu->thismonth  = '本月|my|dynamic|period=thismonth';
$lang->my->dynamic->menu->lastmonth  = '上月|my|dynamic|period=lastmonth';
$lang->my->dynamic->menu->all        = '所有|my|dynamic|period=all';
