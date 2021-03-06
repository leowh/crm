<?php
/**
 * The zh-cn file of crm common module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     common 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
$lang->app = new stdclass();
$lang->app->name = 'CRM';

$lang->menu->crm = new stdclass();
$lang->menu->crm->dashboard = '首页|dashboard|index|';
$lang->menu->crm->order     = '订单|order|browse|';
$lang->menu->crm->contract  = '合同|contract|browse|mode=unfinished';
$lang->menu->crm->customer  = '客户|customer|browse|';
$lang->menu->crm->contact   = '联系人|contact|browse|';
$lang->menu->crm->product   = '产品|product|browse|';
$lang->menu->crm->setting   = '设置|setting|lang|module=product&field=statusList';

/* Menu of customer module. */
$lang->customer = new stdclass();
$lang->customer->menu = new stdclass();
$lang->customer->menu->browse       = '所有客户|customer|browse|mode=all';
$lang->customer->menu->assignedTo   = '指派给我|customer|browse|mode=assignedTo';
$lang->customer->menu->past         = '亟需联系|customer|browse|mode=past';
$lang->customer->menu->today        = '今天联系|customer|browse|mode=today';
$lang->customer->menu->tomorrow     = '明天联系|customer|browse|mode=tomorrow';
$lang->customer->menu->thisweek     = '本周内联系|customer|browse|mode=thisweek';
$lang->customer->menu->thismonth    = '本月内联系|customer|browse|mode=thismonth';
$lang->customer->menu->public       = '客户池|customer|browse|mode=public';
$lang->customer->menu->report       = '报表|report|browse|module=customer';

/* Menu of product module. */
$lang->product = new stdclass();
$lang->product->menu = new stdclass();
$lang->product->menu->browse     = '所有产品|product|browse|mode=all';
$lang->product->menu->normal     = '正常|product|browse|mode=normal';
$lang->product->menu->developing = '研发中|product|browse|mode=developing';
$lang->product->menu->offline    = '下线|product|browse|mode=offline';

/* Menu of order module. */
$lang->order = new stdclass();
$lang->order->menu = new stdclass();
$lang->order->menu->browse       = '所有订单|order|browse|mode=all';
$lang->order->menu->assignedTo   = '指派给我|order|browse|mode=assignedTo';
$lang->order->menu->past         = '亟需联系|order|browse|mode=past';
$lang->order->menu->today        = '今天联系|order|browse|mode=today';
$lang->order->menu->tomorrow     = '明天联系|order|browse|mode=tomorrow';
$lang->order->menu->thisweek     = '本周内联系|order|browse|mode=thisweek';
$lang->order->menu->thismonth    = '本月内联系|order|browse|mode=thismonth';
$lang->order->menu->public       = '公共客户|order|browse|mode=public';
$lang->order->menu->report       = '报表|report|browse|module=order';

/* Menu of contact module. */
$lang->contact = new stdclass();
$lang->contact->menu = new stdclass();
$lang->contact->menu->browse    = '所有联系人|contact|browse|mode=all';
$lang->contact->menu->past      = '亟需联系|contact|browse|mode=past';
$lang->contact->menu->today     = '今天联系|contact|browse|mode=today';
$lang->contact->menu->tomorrow  = '明天联系|contact|browse|mode=tomorrow';
$lang->contact->menu->thisweek  = '本周内联系|contact|browse|mode=thisweek';
$lang->contact->menu->thismonth = '本月内联系|contact|browse|mode=thismonth';

/* Menu of contract module. */
$lang->contract = new stdclass();
$lang->contract->menu = new stdclass();
$lang->contract->menu->browse       = '所有合同|contract|browse|mode=all';
$lang->contract->menu->unfinished   = '未完成|contract|browse|mode=unfinished';
$lang->contract->menu->unreceived   = '回款中|contract|browse|mode=unreceived';
$lang->contract->menu->undeliveried = '交付中|contract|browse|mode=undeliveried';
$lang->contract->menu->finished     = '已完成|contract|browse|mode=finished';
$lang->contract->menu->canceled     = '已取消|contract|browse|mode=canceled';
$lang->contract->menu->expired      = '已过期|contract|browse|mode=expired';
$lang->contract->menu->expire       = '即将到期|contract|browse|mode=expire';
$lang->contract->menu->report       = '报表|report|browse|module=contract';

/* Menu of setting module. */
$lang->setting = new stdclass();
$lang->setting->menu = new stdclass();
$lang->setting->menu->product        = '产品状态|setting|lang|module=product&field=statusList';
$lang->setting->menu->productLine    = '产品线|setting|lang|module=product&field=lineList';
$lang->setting->menu->customerType   = '客户类型|setting|lang|module=customer&field=typeList';
$lang->setting->menu->customerSize   = '客户规模|setting|lang|module=customer&field=sizeNameList';
$lang->setting->menu->customerLevel  = '客户等级|setting|lang|module=customer&field=levelNameList';
$lang->setting->menu->customerStatus = '客户状态|setting|lang|module=customer&field=statusList';
$lang->setting->menu->area           = '区域设置|tree|browse|type=area|';
$lang->setting->menu->industry       = '行业设置|tree|browse|type=industry|';
$lang->setting->menu->currency       = '货币设置|setting|lang|module=common&field=currencyList';
$lang->setting->menu->salesGroup     = array('link' => '销售分组|sales|browse|', 'alias' => 'create,edit');
$lang->setting->menu->customerPool   = '客户池|setting|customerpool|';

/* Menu of sales module. */
$lang->sales = new stdclass();
$lang->sales->menu = $lang->setting->menu;

$lang->dashboard = new stdclass();
$lang->resume    = new stdclass();
$lang->address   = new stdclass();
