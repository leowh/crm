<?php
/**
 * The zh-cn file of my module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     my 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
$lang->my = new stdclass();
$lang->my->common = 'Dashbord';

$lang->my->review = new stdclass();
$lang->my->review->menu = new stdclass();
$lang->my->review->menu->attend = 'Attend|my|review|type=attend';
$lang->my->review->menu->leave  = 'Leave|my|review|type=leave';
$lang->my->review->menu->refund = 'Refund|my|review|type=refund';

$lang->my->order = new stdclass();
$lang->my->order->common = 'Order';

$lang->my->order->menu = new stdclass();
$lang->my->order->menu->past       = 'Urgently need contacted|my|order|type=past';
$lang->my->order->menu->today      = 'Contact Today|my|order|type=today';
$lang->my->order->menu->tomorrow   = 'Contact Tomorrow|my|order|type=tomorrow';
$lang->my->order->menu->assignedTo = 'Assigned To Me|my|order|type=assignedTo';
$lang->my->order->menu->createdBy  = 'Created By Me|my|order|type=createdBy';
$lang->my->order->menu->signedBy   = 'Signed By Me|my|order|type=signedBy';
$lang->my->order->menu->all        = 'All|my|order|type=all';

$lang->my->contract = new stdclass();
$lang->my->contract->common = 'Contract';

$lang->my->contract->menu = new stdclass();
$lang->my->contract->menu->unfinished  = 'Unfinished|my|contract|type=unfinished';
$lang->my->contract->menu->finished    = 'Finished|my|contract|type=finished';
$lang->my->contract->menu->canceled    = 'Canceled|my|contract|type=canceled';
$lang->my->contract->menu->returnedBy  = 'Returned By Me|my|contract|type=returnedBy';
$lang->my->contract->menu->deliveredBy = 'Delivered By Me|my|contract|type=deliveredBy';

$lang->my->company = new stdclass();
$lang->my->company->common  = 'Todo';
$lang->my->company->dept    = 'Department';
$lang->my->company->all     = 'All';
$lang->my->company->account = 'User';
$lang->my->company->begin   = 'Begin';
$lang->my->company->end     = 'End';
$lang->my->company->view    = 'View';

$lang->my->task = new stdclass();
$lang->my->task->common     = 'My Task';
$lang->my->task->assignedTo = 'Assigned To Me';
$lang->my->task->createdBy  = 'Created By Me';
$lang->my->task->finishedBy = 'Finished By Me';
$lang->my->task->closedBy   = 'Closed By Me';
$lang->my->task->canceledBy = 'Canceled By Me';

$lang->my->task->menu = new stdclass();
$lang->my->task->menu->assignedToMe = 'Assigned To Me|my|task|type=assignedTo';
$lang->my->task->menu->createdByMe  = 'Created By Me|my|task|type=createdBy';
$lang->my->task->menu->finishedByMe = 'Finished By Me|my|task|type=finishedBy';
$lang->my->task->menu->closedByMe   = 'Closed By Me|my|task|type=closedBy';
$lang->my->task->menu->canceledByMe = 'Canceled By Me|my|task|type=canceledBy';

$lang->my->project = new stdclass();
$lang->my->project->common = 'My Project';

$lang->my->dynamic = new stdclass();
$lang->my->dynamic->common = 'My Dynamic';

$lang->my->dynamic->menu = new stdclass();
$lang->my->dynamic->menu->today      = 'Today|my|dynamic|period=today';
$lang->my->dynamic->menu->yesterday  = 'Yesterday|my|dynamic|period=yesterday';
$lang->my->dynamic->menu->twodaysago = 'The Day Before Yesterday|my|dynamic|period=twodaysago';
$lang->my->dynamic->menu->thisweek   = 'This Week|my|dynamic|period=thisweek';
$lang->my->dynamic->menu->lastweek   = 'Last Week|my|dynamic|period=lastweek';
$lang->my->dynamic->menu->thismonth  = 'This Month|my|dynamic|period=thismonth';
$lang->my->dynamic->menu->lastmonth  = 'Last Month|my|dynamic|period=lastmonth';
$lang->my->dynamic->menu->all        = 'All|my|dynamic|period=all';
