<?php
/**
 * The create view file of article module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     article
 * @version     $Id: create.html.php 3138 2015-11-09 07:32:18Z chujilu $
 * @link        http://www.ranzhico.com
 */
?>
<?php include $app->getModuleRoot() . 'common/view/header.html.php';?>
<?php include '../../../sys/common/view/kindeditor.html.php';?>
<?php include '../../../sys/common/view/chosen.html.php';?>
<?php js::set('type', $type);?>
<?php js::set('categoryID', $currentCategory);?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-plus'></i>&nbsp;<?php echo $lang->{$type}->create;?></strong></div>
  <div class='panel-body'>
    <form method='post' role='form' id='ajaxForm'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->article->category;?></th>
          <td class='w-p40'><?php echo html::select("categories[]", $categories, $currentCategory, "multiple='multiple' class='form-control chosen'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->article->title;?></th>
          <td colspan='2'><?php echo html::input('title', '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->article->keywords;?></th>
          <td colspan='2'><?php echo html::input('keywords', '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->article->content;?></th>
          <td colspan='2'><?php echo html::textarea('content', '', "rows='20' class='form-control'");?></td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'>
            <?php echo html::submitButton() . html::hidden('type', $type);?> 
            <?php if($type != 'blog') echo html::commonButton($lang->article->createDraft, "btn btn-default draft");?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include $app->getModuleRoot() . 'common/view/footer.html.php';?>
