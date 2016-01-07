<?php
/**
 * The browse view file of purchase module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     purchase
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php js::set('mode', $mode);?>
<li id='bysearchTab'><?php echo html::a('#', "<i class='icon-search icon'></i>" . $lang->search->common)?></li>
<div id='menuActions'>
  <?php if(commonModel::hasPriv('purchase', 'export')):?>
  <div class='btn-group'>
    <button data-toggle='dropdown' class='btn btn-primary dropdown-toggle' type='button'><?php $lang->exportIcon . $lang->export;?> <span class='caret'></span></button>
    <ul id='exportActionMenu' class='dropdown-menu'>
      <li><?php commonModel::printLink('purchase', 'export', "mode=all&orderBy={$orderBy}", $lang->exportAll, "class='iframe' data-width='700'");?></li>
      <li><?php commonModel::printLink('purchase', 'export', "mode=thisPage&orderBy={$orderBy}", $lang->exportThisPage, "class='iframe' data-width='700'");?></li>
    </ul>
  </div>
  <?php endif;?>
  <?php commonModel::printLink('purchase', 'create', '', '<i class="icon-plus"></i> ' . $lang->purchase->create, "class='btn btn-primary'");?>
</div>
<div class='panel'>
  <table class='table table-hover table-striped tablesorter table-data table-fixed' id='purchaseList'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "mode={$mode}&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";?>
        <th class='w-60px'> <?php commonModel::printOrderLink('id',          $orderBy, $vars, $lang->purchase->id);?></th>
        <th class='w-300px'> <?php commonModel::printOrderLink('code',       $orderBy, $vars, $lang->purchase->code);?></th>
        <th>                <?php commonModel::printOrderLink('name',        $orderBy, $vars, $lang->purchase->name);?></th>
        <th class='w-100px'><?php commonModel::printOrderLink('amount',      $orderBy, $vars, $lang->purchase->amount);?></th>
        <th class='w-100px visible-lg'><?php commonModel::printOrderLink('createdDate', $orderBy, $vars, $lang->purchase->createdDate);?></th>
        <th class='w-80px'> <?php commonModel::printOrderLink('return',      $orderBy, $vars, $lang->purchase->return);?></th>
        <th class='w-80px'> <?php commonModel::printOrderLink('delivery',    $orderBy, $vars, $lang->purchase->delivery);?></th>
        <th class='w-60px'> <?php commonModel::printOrderLink('status',      $orderBy, $vars, $lang->purchase->status);?></th>
        <th class='w-210px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($purchases as $purchase):?>
      <tr class='text-center' data-url='<?php echo inlink('view', "purchaseID=$purchase->id"); ?>'>
        <td><?php echo $purchase->id;?></td>
        <td class='text-left'><?php echo $purchase->code;?></td>
        <td class='text-left' title='<?php echo $purchase->name;?>'><?php echo $purchase->name;?></td>
        <td class='text-right'><?php echo zget($currencySign, $purchase->currency, '') . formatMoney($purchase->amount);?></td>
        <td class='visible-lg'><?php echo substr($purchase->createdDate, 0, 10);?></td>
        <td><?php echo $lang->purchase->returnList[$purchase->return];?></td>
        <td><?php echo $lang->purchase->deliveryList[$purchase->delivery];?></td>
        <td class='<?php echo "purchase-{$purchase->status}";?>'><?php echo $lang->purchase->statusList[$purchase->status];?></td>
        <td class='operate'><?php echo $this->purchase->buildOperateMenu($purchase) ?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  <div class='table-footer'>
    <?php if(isset($totalAmount)):?>
    <div class='pull-left text-danger'>
      <?php if(!empty($totalAmount)) printf($lang->purchase->totalAmount, implode('，', $totalAmount['purchase']), implode('，', $totalAmount['return']));?>
    </div>
    <?php endif;?>
    <?php $pager->show();?>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
