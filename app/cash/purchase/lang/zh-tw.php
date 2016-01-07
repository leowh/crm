<?php
/**
 * The zh-tw file of crm purchase module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     purchase 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
if(!isset($lang->purchase)) $lang->purchase = new stdclass();
$lang->purchase->common = '合同';

$lang->purchase->id            = '編號';
$lang->purchase->order         = '簽約訂單';
$lang->purchase->customer      = '所屬客戶';
$lang->purchase->name          = '名稱';
$lang->purchase->code          = '合同編號';
$lang->purchase->amount        = '金額';
$lang->purchase->currency      = '貨幣類型';
$lang->purchase->all           = '合同總額';
$lang->purchase->thisAmount    = '本次回款';
$lang->purchase->items         = '主要條款';
$lang->purchase->begin         = '開始日期';
$lang->purchase->end           = '結束日期';
$lang->purchase->dateRange     = '起止日期';
$lang->purchase->delivery      = '交付';
$lang->purchase->deliveredBy   = '由誰交付';
$lang->purchase->deliveredDate = '交付時間';
$lang->purchase->return        = '回款';
$lang->purchase->returnedBy    = '由誰回款';
$lang->purchase->returnedDate  = '回款時間';
$lang->purchase->status        = '狀態';
$lang->purchase->contact       = '聯繫人';
$lang->purchase->signedBy      = '由誰簽署';
$lang->purchase->signedDate    = '簽署日期';
$lang->purchase->finishedBy    = '由誰完成';
$lang->purchase->finishedDate  = '完成時間';
$lang->purchase->canceledBy    = '由誰取消';
$lang->purchase->canceledDate  = '取消時間';
$lang->purchase->createdBy     = '由誰創建';
$lang->purchase->createdDate   = '創建時間';
$lang->purchase->editedBy      = '最後修改';
$lang->purchase->editedDate    = '最後修改時間';
$lang->purchase->handlers      = '經手人';
$lang->purchase->contactedBy   = '由誰聯繫';
$lang->purchase->contactedDate = '最後聯繫';
$lang->purchase->nextDate      = '下次聯繫';

$lang->purchase->browse           = '瀏覽合同';
$lang->purchase->receive          = '回款';
$lang->purchase->cancel           = '取消合同';
$lang->purchase->view             = '合同詳情';
$lang->purchase->finish           = '完成合同';
$lang->purchase->record           = '溝通';
$lang->purchase->delete           = '刪除合同';
$lang->purchase->list             = '合同列表';
$lang->purchase->create           = '創建合同';
$lang->purchase->edit             = '編輯合同';
$lang->purchase->setting          = '系統設置';
$lang->purchase->uploadFile       = '上傳附件';
$lang->purchase->lifetime         = '合同的一生';
$lang->purchase->returnRecords    = '回款記錄';
$lang->purchase->deliveryRecords  = '交付記錄';
$lang->purchase->completeReturn   = '完成回款';
$lang->purchase->completeDelivery = '完成交付';
$lang->purchase->editReturn       = '編輯回款';
$lang->purchase->editDelivery     = '編輯交付';
$lang->purchase->deleteReturn     = '刪除回款';
$lang->purchase->deleteDelivery   = '刪除交付';
$lang->purchase->export           = '導出';

$lang->purchase->deliveryList[]        = '';
$lang->purchase->deliveryList['wait']  = '等待交付';
$lang->purchase->deliveryList['doing'] = '交付中';
$lang->purchase->deliveryList['done']  = '交付完成';

$lang->purchase->returnList[]        = '';
$lang->purchase->returnList['wait']  = '等待回款';
$lang->purchase->returnList['doing'] = '回款中';
$lang->purchase->returnList['done']  = '回款完成';

$lang->purchase->statusList[]           = '';
$lang->purchase->statusList['normal']   = '正常';
$lang->purchase->statusList['closed']   = '已完成';
$lang->purchase->statusList['canceled'] = '已取消';

$lang->purchase->codeUnitList[]        = '';
$lang->purchase->codeUnitList['Y']     = '年';
$lang->purchase->codeUnitList['m']     = '月';
$lang->purchase->codeUnitList['d']     = '日';
$lang->purchase->codeUnitList['fix']   = '固定值';
$lang->purchase->codeUnitList['input'] = '輸入值';

$lang->purchase->placeholder = new stdclass();
$lang->purchase->placeholder->real = '成交金額';

$lang->purchase->totalAmount        = '本頁合同總金額：%s，已回款：%s；';
$lang->purchase->returnInfo         = "<p>%s, 由 <strong>%s</strong> 回款%s。</p>";
$lang->purchase->deliveryInfo       = "<p>%s由%s交付。</p>";
$lang->purchase->deleteReturnInfo   = "%s的回款%s";
$lang->purchase->deleteDeliveryInfo = "%s的交付";
