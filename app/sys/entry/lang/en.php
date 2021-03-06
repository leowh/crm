<?php
/**
 * The English file of entry module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     entry 
 * @version     $Id: en.php 3205 2015-11-23 06:27:38Z daitingting $
 * @link        http://www.ranzhico.com
 */
$lang->entry->common    = 'App';
$lang->entry->admin     = 'App list';
$lang->entry->create    = 'Create App';
$lang->entry->edit      = 'Edit App';
$lang->entry->delete    = 'Delete App';
$lang->entry->createKey = 'New one';
$lang->entry->order     = 'Order';
$lang->entry->style     = 'Style';

$lang->entry->name        = 'Name';
$lang->entry->abbr        = 'Abbreviation';
$lang->entry->code        = 'Code';
$lang->entry->buildin     = 'Build-in';
$lang->entry->integration = 'Integration';
$lang->entry->key         = 'Key';
$lang->entry->block       = 'Block url';
$lang->entry->ip          = 'IP list';
$lang->entry->logo        = 'Logo';
$lang->entry->login       = 'Access url';
$lang->entry->logout      = 'Logout url';
$lang->entry->nothing     = 'No records.';
$lang->entry->open        = 'Open';
$lang->entry->control     = 'Window Control';
$lang->entry->size        = 'Window Size';
$lang->entry->position    = 'Position';
$lang->entry->width       = 'Width';
$lang->entry->height      = 'Height';
$lang->entry->priv        = 'Privilege';

$lang->entry->chanzhi          = 'Chanzhi';
$lang->entry->zentao           = 'Zentao';
$lang->entry->integrateChanzhi = 'Integrate ChanZhi';
$lang->entry->integrateZentao  = 'Integrate ZenTao';

$lang->entry->chanzhiPlaceholder = 'Please input url of admin';
$lang->entry->chanzhiURL         = 'Url of admin';
$lang->entry->zentaoPlaceholder  = 'Example: http://www.zentaopms.com/user-login-Lw==.html';
$lang->entry->zentaoURL          = 'Login url of zentao';

$lang->entry->zentaoAdmin   = 'Zentao Admin';
$lang->entry->adminAccount  = 'Admin account';
$lang->entry->adminPassword = 'Admin password';
$lang->entry->bindUser      = 'Bind User';
$lang->entry->nextStep      = 'Next Step';
$lang->entry->createUser    = 'Create User';

$lang->entry->confirmDelete = 'Are you sure to delete this App?';
$lang->entry->lblBlock      = 'Block';
$lang->entry->editWarnning  = 'The system application, careful edit.';

$lang->entry->note = new stdClass();
$lang->entry->note->name    = 'Entry name';
$lang->entry->note->abbr    = 'Two character abbreviation';
$lang->entry->note->logo    = 'Logo size 64*64. if upload the PNG format, you must keep transparency';
$lang->entry->note->code    = 'Entry code, it should be english, digital or underline';
$lang->entry->note->login   = 'The url of login or access app';
$lang->entry->note->logout  = 'The url of logout app';
$lang->entry->note->visible = 'Display on the left bar';
$lang->entry->note->api     = 'The url of getting blocks';
$lang->entry->note->ip      = "Use comma between two IPs, and support IP segment, for example 192.168.1.*";
$lang->entry->note->allip   = 'All IP';

$lang->entry->error = new stdClass();
$lang->entry->error->name  = 'Please input name';
$lang->entry->error->code  = 'Please input code';
$lang->entry->error->key   = 'Please input key';
$lang->entry->error->ip    = 'Please input IP';
$lang->entry->error->url   = 'Non built-in application login address, you must include the /, http:// or https://';

$lang->entry->error->admin         = 'Wrong admin account or password.';
$lang->entry->error->zentaoSetting = 'ZentaoPMS set config failed, Please upgrade ZentaoPMS to head.';
$lang->entry->error->zentaoUrl     = 'Wrong ZentaoPMS login url.';
$lang->entry->error->accessDenied  = 'Access denied';

$lang->entry->openList['blank']  = 'Blank';
$lang->entry->openList['iframe'] = 'Iframe';

$lang->entry->sizeList['max']    = 'Maximize';
$lang->entry->sizeList['custom'] = 'Custom';

$lang->entry->positionList['default'] = 'Default';
$lang->entry->positionList['center']  = 'Center';

$lang->entry->controlList['none']   = 'None';
$lang->entry->controlList['full']   = 'Full';
$lang->entry->controlList['simple'] = 'Transparent';

$lang->entry->integrationList[1] = 'Open';
$lang->entry->integrationList[0] = 'Close';
