<?php
/**
 * The create view file of holiday module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      chujilu <chujilu@cnezsoft.com>
 * @package     attend
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
?>
<?php include '../../../sys/common/view/header.modal.html.php';?>
<?php include '../../../sys/common/view/datepicker.html.php';?>
<div class='panel-body'>
    <form id='ajaxForm' method='post' action="<?php echo $this->createLink('oa.holiday', 'edit', "id=$holiday->id")?>">
    <table class='table table-form table-condensed'>
      <tr>
        <th><?php echo $lang->holiday->name?></th>
        <td><?php echo html::input('name', $holiday->name, "class='form-control'")?></td>
        <td></td>
      </tr>
      <tr>
        <th><?php echo $lang->holiday->begin?></th>
        <td><?php echo html::input('begin', $holiday->begin, "class='form-control form-date'")?></td>
        <td></td>
      </tr>
      <tr>
        <th><?php echo $lang->holiday->end?></th>
        <td><?php echo html::input('end', $holiday->end, "class='form-control form-date'")?></td>
        <td></td>
      </tr>
      <tr>
        <th><?php echo $lang->holiday->desc?></th>
        <td><?php echo html::textarea('desc', $holiday->desc, "class='form-control'")?></td>
        <td></td>
      </tr> 
      <tr><th></th><td clospan='2'><?php echo html::submitButton();?></td></tr>
    </table>
  </form>
</div>
<?php include '../../../sys/common/view/footer.modal.html.php';?>
