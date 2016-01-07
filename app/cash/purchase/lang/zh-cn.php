<?php
/**
 * The zh-cn file of crm purchase module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     purchase 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
if(!isset($lang->purchase)) $lang->purchase = new stdclass();
$lang->purchase->common = '采购';
$lang->purchase->depositor = '账户';

$lang->purchase->id            = '编号';
$lang->purchase->order         = '签约订单';
$lang->purchase->customer      = '所属供应商';
$lang->purchase->name          = '名称';
$lang->purchase->code          = '合同编号';
$lang->purchase->codeID	       = 'LZYBUY-';
$lang->purchase->amount        = '金额';
$lang->purchase->currency      = '货币类型';
$lang->purchase->all           = '合同总额';
$lang->purchase->thisAmount    = '本次支付';
$lang->purchase->items         = '主要条款';
$lang->purchase->begin         = '开始日期';
$lang->purchase->end           = '结束日期';
$lang->purchase->dateRange     = '起止日期';
$lang->purchase->delivery      = '交付';
$lang->purchase->deliveredBy   = '由谁交付';
$lang->purchase->deliveredDate = '交付时间';
$lang->purchase->return        = '支付';
$lang->purchase->returnedBy    = '由谁支付';
$lang->purchase->returnedDate  = '支付时间';
$lang->purchase->status        = '状态';
$lang->purchase->contact       = '联系人';
$lang->purchase->signedBy      = '由谁签署';
$lang->purchase->signedDate    = '签署日期';
$lang->purchase->finishedBy    = '由谁完成';
$lang->purchase->finishedDate  = '完成时间';
$lang->purchase->canceledBy    = '由谁取消';
$lang->purchase->canceledDate  = '取消时间';
$lang->purchase->createdBy     = '由谁创建';
$lang->purchase->createdDate   = '创建时间';
$lang->purchase->editedBy      = '最后修改';
$lang->purchase->editedDate    = '最后修改时间';
$lang->purchase->handlers      = '经手人';
$lang->purchase->contactedBy   = '由谁联系';
$lang->purchase->contactedDate = '最后联系';
$lang->purchase->nextDate      = '下次联系';

$lang->purchase->browse           = '浏览采购';
$lang->purchase->receive          = '支付';
$lang->purchase->cancel           = '取消采购';
$lang->purchase->view             = '采购详情';
$lang->purchase->finish           = '完成采购';
$lang->purchase->record           = '沟通';
$lang->purchase->delete           = '删除采购';
$lang->purchase->list             = '采购列表';
$lang->purchase->create           = '创建采购';
$lang->purchase->edit             = '编辑采购';
$lang->purchase->setting          = '系统设置';
$lang->purchase->uploadFile       = '上传附件';
$lang->purchase->lifetime         = '采购的一生';
$lang->purchase->returnRecords    = '支付记录';
$lang->purchase->deliveryRecords  = '交付记录';
$lang->purchase->completeReturn   = '完成支付';
$lang->purchase->completeDelivery = '完成交付';
$lang->purchase->editReturn       = '编辑支付';
$lang->purchase->editDelivery     = '编辑交付';
$lang->purchase->deleteReturn     = '删除支付';
$lang->purchase->deleteDelivery   = '删除交付';
$lang->purchase->export           = '导出';

$lang->purchase->deliveryList[]        = '';
$lang->purchase->deliveryList['wait']  = '等待交付';
$lang->purchase->deliveryList['doing'] = '交付中';
$lang->purchase->deliveryList['done']  = '交付完成';

$lang->purchase->returnList[]        = '';
$lang->purchase->returnList['wait']  = '等待支付';
$lang->purchase->returnList['doing'] = '部分支付';
$lang->purchase->returnList['done']  = '支付完成';

$lang->purchase->statusList[]           = '';
$lang->purchase->statusList['normal']   = '正常';
$lang->purchase->statusList['closed']   = '已完成';
$lang->purchase->statusList['canceled'] = '已取消';

$lang->purchase->codeUnitList[]        = '';
$lang->purchase->codeUnitList['Y']     = '年';
$lang->purchase->codeUnitList['m']     = '月';
$lang->purchase->codeUnitList['d']     = '日';
$lang->purchase->codeUnitList['fix']   = '固定值';
$lang->purchase->codeUnitList['input'] = '输入值';

$lang->purchase->placeholder = new stdclass();
$lang->purchase->placeholder->real = '成交金额';

$lang->purchase->totalAmount        = '本页采购总金额：%s，已支付：%s；';
$lang->purchase->returnInfo         = "<p>%s, 由 <strong>%s</strong> 支付%s。</p>";
$lang->purchase->deliveryInfo       = "<p>%s由%s交付。</p>";
$lang->purchase->deleteReturnInfo   = "%s的支付%s";
$lang->purchase->deleteDeliveryInfo = "%s的交付";
