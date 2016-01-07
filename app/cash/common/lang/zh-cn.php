<?php
/**
 * The zh-cn file of common module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng wang <chunsheng@cnezsoft.com>
 * @package     common 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
$lang->app = new stdclass();
$lang->app->name = 'CASH';

$lang->menu->cash = new stdclass();
$lang->menu->cash->dashboard = '首页|dashboard|index|';
$lang->menu->cash->trade     = '记账|trade|browse|';
$lang->menu->cash->check     = '对账|depositor|check|';
$lang->menu->cash->depositor = '账户|depositor|browse|';
$lang->menu->cash->purchase  = '采购|purchase|browse|mode=unfinished';
$lang->menu->cash->provider  = '供应商|provider|browse|';
//$lang->menu->cash->contact   = '联系人|contact|browse|';
$lang->menu->cash->setting   = '设置|tree|browse|type=in|';

/* Menu of depositor module. */
$lang->depositor = new stdclass();

/* Menu of trade module. */
$lang->trade = new stdclass();
$lang->trade->menu = new stdclass();
$lang->trade->menu->browse   = array('link' => '所有账目|trade|browse|mode=all');
$lang->trade->menu->in       = array('link' => '收入|trade|browse|mode=in');
$lang->trade->menu->out      = array('link' => '支出|trade|browse|mode=out');
$lang->trade->menu->transfer = array('link' => '转账|trade|browse|mode=transfer');
$lang->trade->menu->inveset  = array('link' => '投资|trade|browse|mode=inveset&orderBy=depositor');
$lang->trade->menu->report   = array('link' => '报表|trade|report|');

/* Menu of purchase module. */
$lang->purchase = new stdclass();
$lang->purchase->menu = new stdclass();
$lang->purchase->menu->browse       = '所有采购|purchase|browse|mode=all';
$lang->purchase->menu->unfinished   = '未完成|purchase|browse|mode=unfinished';
$lang->purchase->menu->unreceived   = '支付中|purchase|browse|mode=unreceived';
$lang->purchase->menu->undeliveried = '交付中|purchase|browse|mode=undeliveried';
$lang->purchase->menu->finished     = '已完成|purchase|browse|mode=finished';

/* Menu of trade module. */
$lang->provider = new stdclass();
$lang->provider->menu = new stdclass();
$lang->provider->menu->browse = array('link' => '供应商列表|provider|browse|', 'alias' => 'create,edit,view');

/* Menu of trade module. */
$lang->contact = new stdclass();
$lang->contact->menu = new stdclass();
$lang->contact->menu->browse = array('link' => '联系人列表|contact|browse|', 'alias' => 'create,edit,view');

/* Menu of setting module. */
$lang->setting = new stdclass();
$lang->setting->menu = new stdclass();
$lang->setting->menu->income    = '收入科目|tree|browse|type=in|';
$lang->setting->menu->expend    = '支出科目|tree|browse|type=out|';
$lang->setting->menu->currency  = '货币类型|setting|lang|module=common&field=currencyList';
$lang->setting->menu->schema    = '导入模板设置|schema|browse|';
$lang->setting->menu->tradePriv = '支出浏览权限设置|group|managetradepriv|';
