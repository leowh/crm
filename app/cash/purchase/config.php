<?php
/**
 * The config file of purchase module of RanZhi.
 *
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     purchase 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
$config->purchase->require = new stdclass();
$config->purchase->require->create  = 'customer, name';
$config->purchase->require->edit    = 'customer, name';
$config->purchase->require->receive = 'amount';

$config->purchase->editor = new stdclass();
$config->purchase->editor->create       = array('id' => 'items', 'tools' => 'full');
$config->purchase->editor->edit         = array('id' => 'items', 'tools' => 'full');
$config->purchase->editor->receive      = array('id' => 'comment', 'tools' => 'simple');
$config->purchase->editor->delivery     = array('id' => 'comment', 'tools' => 'simple');
$config->purchase->editor->finish       = array('id' => 'comment', 'tools' => 'simple');
$config->purchase->editor->cancel       = array('id' => 'comment', 'tools' => 'simple');
$config->purchase->editor->editreturn   = array('id' => 'comment', 'tools' => 'simple');
$config->purchase->editor->editdelivery = array('id' => 'comment', 'tools' => 'simple');

$config->purchase->codeFormat = array('Y', 'm', 'd', 'input');

global $lang, $app;
$config->purchase->search['module'] = 'purchase';

$config->purchase->search['fields']['name']          = $lang->purchase->name;
$config->purchase->search['fields']['amount']        = $lang->purchase->amount;
$config->purchase->search['fields']['signedDate']    = $lang->purchase->signedDate;
$config->purchase->search['fields']['status']        = $lang->purchase->status;
$config->purchase->search['fields']['createdBy']     = $lang->purchase->createdBy;
$config->purchase->search['fields']['delivery']      = $lang->purchase->delivery;
$config->purchase->search['fields']['deliveredBy']   = $lang->purchase->deliveredBy;
$config->purchase->search['fields']['deliveredDate'] = $lang->purchase->deliveredDate;
$config->purchase->search['fields']['return']        = $lang->purchase->return;
$config->purchase->search['fields']['returnedBy']    = $lang->purchase->returnedBy;
$config->purchase->search['fields']['returnedDate']  = $lang->purchase->returnedDate;
$config->purchase->search['fields']['id']            = $lang->purchase->id;

$config->purchase->search['params']['name']          = array('operator' => 'include', 'control' => 'input', 'values' => '');
$config->purchase->search['params']['amount']        = array('operator' => '>=', 'control' => 'input',  'values' => '');
$config->purchase->search['params']['signedDate']    = array('operator' => '>=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->purchase->search['params']['status']        = array('operator' => '=',  'control' => 'select', 'values' => $lang->purchase->statusList);
$config->purchase->search['params']['createdBy']     = array('operator' => '=',  'control' => 'select', 'values' => 'users');
$config->purchase->search['params']['delivery']      = array('operator' => '=',  'control' => 'select', 'values' => $lang->purchase->deliveryList);
$config->purchase->search['params']['deliveredBy']   = array('operator' => '=',  'control' => 'select', 'values' => 'users');
$config->purchase->search['params']['deliveredDate'] = array('operator' => '>=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->purchase->search['params']['return']        = array('operator' => '=',  'control' => 'select', 'values' => $lang->purchase->returnList);
$config->purchase->search['params']['returnedBy']    = array('operator' => '=',  'control' => 'select', 'values' => 'users');
$config->purchase->search['params']['returnedDate']  = array('operator' => '>=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->purchase->search['params']['id']            = array('operator' => '=',  'control' => 'input',  'values' => '');

$config->purchase->list = new stdclass();
$config->purchase->list->exportFields = '
  id, customer, order, name, code, amount, currency, begin, end,
  delivery, return, status, contact, handlers, signedBy, signedDate,
  deliveredBy, deliveredDate, returnedBy, returnedDate, finishedBy, finishedDate,
  canceledBy, canceledDate, createdBy, createdDate, editedBy, editedDate,
  contactedBy, contactedDate, nextDate, items, files';
