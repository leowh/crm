<?php
/**
 * The view file of thread module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     thread
 * @version     $Id: view.html.php 3138 2015-11-09 07:32:18Z chujilu $
 * @link        http://www.ranzhico.com
 */
include '../../common/view/header.html.php';
include '../../../sys/common/view/kindeditor.html.php';
js::set('boardID', $board->id);
?>
<div class='row'>
  <?php include './side.html.php';?>
  <div class='col-md-10'>
    <?php
    if($pager->pageID == 1) include './thread.html.php';
    if(!$thread->readonly)  include './reply.html.php';
    else echo "<div class='alert alert-info'>{$lang->thread->readonlyMessage}</div>";
    ?>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
