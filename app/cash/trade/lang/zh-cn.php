<?php
/**
 * The trade module zh-cn file of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     trade
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
if(!isset($lang->trade)) $lang->trade = new stdclass();
$lang->trade->common      = '记账';
$lang->trade->id          = '编号';
$lang->trade->depositor   = '账号';
$lang->trade->type        = '交易';
$lang->trade->currency    = '货币';
$lang->trade->trader      = '商户';
$lang->trade->customer    = '客户';
$lang->trade->money       = '金额';
$lang->trade->desc        = '说明';
$lang->trade->product     = '产品';
$lang->trade->order       = '订单';
$lang->trade->contract    = '合同';
$lang->trade->category    = '科目';
$lang->trade->date        = '时间';
$lang->trade->handlers    = '经办人';
$lang->trade->dept        = '部门';
$lang->trade->receipt     = '收款账户';
$lang->trade->payment     = '付款账户';
$lang->trade->fee         = '手续费';
$lang->trade->transferIn  = '转入金额';
$lang->trade->transferOut = '转出金额';
$lang->trade->schema      = '模板';
$lang->trade->importFile  = '导入文件';
$lang->trade->encode      = '编码';
$lang->trade->createdBy   = '由谁创建';
$lang->trade->createdDate = '创建时间';
$lang->trade->editedBy    = '由谁编辑';
$lang->trade->editedDate  = '编辑时间';
$lang->trade->month       = '月份';

$lang->trade->create      = '记账';
$lang->trade->in          = '收入';
$lang->trade->out         = '支出';
$lang->trade->inveset     = '投资';
$lang->trade->redeem      = '赎回';
$lang->trade->createIn    = '记收入';
$lang->trade->createOut   = '记支出';
$lang->trade->transfer    = '记转账';
$lang->trade->edit        = '编辑账目';
$lang->trade->detail      = '明细';
$lang->trade->browse      = '账目列表';
$lang->trade->delete      = '删除记录';
$lang->trade->batchCreate = '批量记账';
$lang->trade->batchEdit   = '批量编辑';
$lang->trade->newTrader   = '新建';
$lang->trade->import      = '导入';
$lang->trade->export      = '导出';
$lang->trade->showImport  = '导入确认';
$lang->trade->report      = '报表';
$lang->trade->fullYear    = '全年';

$lang->trade->typeList['in']          = '收入';
$lang->trade->typeList['out']         = '支出';
$lang->trade->typeList['transferout'] = '转出';
$lang->trade->typeList['transferin']  = '转入';
$lang->trade->typeList['inveset']     = '投资';
$lang->trade->typeList['redeem']      = '赎回';

$lang->trade->modeList['all']      = '所有账目';
$lang->trade->modeList['in']       = '收入';
$lang->trade->modeList['out']      = '支出';
$lang->trade->modeList['transfer'] = '转账';
$lang->trade->modeList['inveset']  = '投资';

$lang->trade->quarters = new stdclass();
$lang->trade->quarters->Q1 = '01,02,03';
$lang->trade->quarters->Q2 = '04,05,06';
$lang->trade->quarters->Q3 = '07,08,09';
$lang->trade->quarters->Q4 = '10,11,12';

$lang->trade->quarterList['Q1'] = '第一季度';
$lang->trade->quarterList['Q2'] = '第二季度';
$lang->trade->quarterList['Q3'] = '第三季度';
$lang->trade->quarterList['Q4'] = '第四季度';

$lang->trade->monthList['01'] = '一月';
$lang->trade->monthList['02'] = '二月';
$lang->trade->monthList['03'] = '三月';
$lang->trade->monthList['04'] = '四月';
$lang->trade->monthList['05'] = '五月';
$lang->trade->monthList['06'] = '六月';
$lang->trade->monthList['07'] = '七月';
$lang->trade->monthList['08'] = '八月';
$lang->trade->monthList['09'] = '九月';
$lang->trade->monthList['10'] = '十月';
$lang->trade->monthList['11'] = '十一月';
$lang->trade->monthList['12'] = '十二月';

$lang->trade->categoryList['transferin']  = '转入';
$lang->trade->categoryList['transferout'] = '转出';
$lang->trade->categoryList['inveset']     = '投资';
$lang->trade->categoryList['redeem']      = '赎回';

$lang->trade->expenseCategoryList['fee']  = '手续费';
$lang->trade->expenseCategoryList['loss'] = '理财亏损';

$lang->trade->incomeCategoryList['profit'] = '理财盈利';

$lang->trade->categoryList = $lang->trade->categoryList + $lang->trade->expenseCategoryList + $lang->trade->incomeCategoryList;

$lang->trade->invesetCategoryList['profit'] = '盈利';
$lang->trade->invesetCategoryList['loss']   = '亏损';

$lang->trade->objectTypeList['order']    = '订单支出';
$lang->trade->objectTypeList['contract'] = '合同支出';

$lang->trade->invesetTypeList['inveset'] = '投资';
$lang->trade->invesetTypeList['redeem']  = '赎回';

$lang->trade->encodeList['gbk']  = 'GBK';
$lang->trade->encodeList['utf8'] = 'UTF-8';

$lang->trade->notEqual = '付款账号不能与收款账号相同。';
$lang->trade->feeDesc  = '%s %s 转入 %s';
$lang->trade->fileNode = '文件格式为csv';

$lang->trade->importedFields = array();
$lang->trade->importedFields['category'] = '项目';
$lang->trade->importedFields['type']     = '交易类型';
$lang->trade->importedFields['trader']   = '商户';
$lang->trade->importedFields['in']       = '收入';
$lang->trade->importedFields['out']      = '支出';
$lang->trade->importedFields['date']     = '时间';
$lang->trade->importedFields['category'] = '科目';
$lang->trade->importedFields['dept']     = '部门';
$lang->trade->importedFields['desc']     = '备注';
$lang->trade->importedFields['fee']      = '手续费';

$lang->trade->totalIn       = '%s收入%s；';
$lang->trade->totalOut      = '%s支出%s；';
$lang->trade->totalAmount   = '%s收入%s，支出%s，%s；';
$lang->trade->profit        = '盈';
$lang->trade->loss          = '亏';
$lang->trade->balance       = '收支平衡';
$lang->trade->total         = '总计';
$lang->trade->annualCaption = '年度收支表';

$lang->trade->noTraderMatch = '没有匹配到相应的商户，点击新建';
$lang->trade->unique        = '今天已经有相同金额的账目';
$lang->trade->ignore        = '忽略';

$lang->trade->chartList['category'] = '按科目统计';
$lang->trade->chartList['dept']     = '按部门统计';
