<?php
/**
 * The en file of crm purchase module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     purchase 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
if(!isset($lang->purchase)) $lang->purchase = new stdclass();
$lang->purchase->common = 'Contract';

$lang->purchase->id            = 'ID';
$lang->purchase->order         = 'Order';
$lang->purchase->customer      = 'Customer';
$lang->purchase->name          = 'Name';
$lang->purchase->code          = 'Code';
$lang->purchase->amount        = 'Amount';
$lang->purchase->currency      = 'Currency';
$lang->purchase->all           = 'Total amount';
$lang->purchase->thisAmount    = 'This amount';
$lang->purchase->items         = 'Main items';
$lang->purchase->begin         = 'Start Date';
$lang->purchase->end           = 'End Date';
$lang->purchase->dateRange     = 'Date Range';
$lang->purchase->delivery      = 'Delivery';
$lang->purchase->deliveredBy   = 'Delivered By';
$lang->purchase->deliveredDate = 'Delivered Date';
$lang->purchase->return        = 'Received payments';
$lang->purchase->returnedBy    = 'Received By';
$lang->purchase->returnedDate  = 'Received Date';
$lang->purchase->status        = 'Status';
$lang->purchase->contact       = 'Contact';
$lang->purchase->signedBy      = 'Signed By';
$lang->purchase->signedDate    = 'Signature Date';
$lang->purchase->finishedBy    = 'Finished By';
$lang->purchase->finishedDate  = 'Finished Date';
$lang->purchase->canceledBy    = 'Canceled By';
$lang->purchase->canceledDate  = 'Canceled Date';
$lang->purchase->createdBy     = 'Created By';
$lang->purchase->createdDate   = 'Created Date';
$lang->purchase->editedBy      = 'Edited By';
$lang->purchase->editedDate    = 'Edited Date';
$lang->purchase->handlers      = 'Handlers';
$lang->purchase->contactedBy   = 'Contacted By';
$lang->purchase->contactedDate = 'Contacted Date';
$lang->purchase->nextDate      = 'Next Date';

$lang->purchase->browse           = 'Browse Contract';
$lang->purchase->receive          = 'Receive';
$lang->purchase->cancel           = 'Cancel Contract';
$lang->purchase->view             = 'View Contract';
$lang->purchase->finish           = 'Finish Contract';
$lang->purchase->record           = 'Record';
$lang->purchase->delete           = 'Delete Contract';
$lang->purchase->list             = 'Contract List';
$lang->purchase->create           = 'Create Contract';
$lang->purchase->edit             = 'Edit';
$lang->purchase->setting          = 'Settings';
$lang->purchase->uploadFile       = 'Upload Files';
$lang->purchase->lifetime         = 'Lifetime';
$lang->purchase->returnRecords    = 'Payments records';
$lang->purchase->deliveryRecords  = 'Delivery records';
$lang->purchase->completeReturn   = 'Complete payments';
$lang->purchase->completeDelivery = 'Complete delivery';
$lang->purchase->editReturn       = 'Edit payment';
$lang->purchase->editDelivery     = 'Edit delivery';
$lang->purchase->deleteReturn     = 'Delete Return';
$lang->purchase->deleteDelivery   = 'Delete Delivery';
$lang->purchase->export           = 'Export';

$lang->purchase->deliveryList[]        = '';
$lang->purchase->deliveryList['wait']  = 'Pending';
$lang->purchase->deliveryList['doing'] = 'Doing';
$lang->purchase->deliveryList['done']  = 'Done';

$lang->purchase->returnList[]        = '';
$lang->purchase->returnList['wait']  = 'Pending';
$lang->purchase->returnList['doing'] = 'Doing';
$lang->purchase->returnList['done']  = 'Done';

$lang->purchase->statusList[]           = '';
$lang->purchase->statusList['normal']   = 'Normal';
$lang->purchase->statusList['closed']   = 'Closed';
$lang->purchase->statusList['canceled'] = 'Canceled';

$lang->purchase->codeUnitList[]        = '';
$lang->purchase->codeUnitList['Y']     = 'Year';
$lang->purchase->codeUnitList['m']     = 'Month';
$lang->purchase->codeUnitList['d']     = 'Day';
$lang->purchase->codeUnitList['fix']   = 'Fix';
$lang->purchase->codeUnitList['input'] = 'Input';

$lang->purchase->placeholder = new stdclass();
$lang->purchase->placeholder->real = 'Turnover';

$lang->purchase->totalAmount        = 'The total amount:%s,returned amount:%s in this page;';
$lang->purchase->returnInfo         = "<p>%s, received payments by <strong>%s</strong>, %s.</p>";
$lang->purchase->deliveryInfo       = "<p>%s, delivered by %s.</p>";
$lang->purchase->deleteReturnInfo   = "%s in %s";
$lang->purchase->deleteDeliveryInfo = "in %s";
