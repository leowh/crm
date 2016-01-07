<?php
/**
 * The control file of todo module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     todo
 * @version     $Id: control.php 4976 2013-07-02 08:15:31Z wyd621@gmail.com $
 * @link        http://www.ranzhico.com
 */
class todo extends control
{
    /**
     * Construct function, load model of date.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->app->loadClass('date');
        $this->loadModel('task');
        $this->loadModel('order', 'crm');
        $this->loadModel('customer', 'crm');
    }

    /**
     * calendar view.
     * 
     * @param  string $date 
     * @access public
     * @return void
     */
    public function calendar($date = '')
    {
        if($date == '' or $date == 'future') $date = date('Ymd');
        $account = $this->app->user->account;
        $todoList['undone']   = $this->todo->getList('self', $account, 'before', 'undone');
        $todoList['custom']   = $this->todo->getList('self', $account, 'future');
        $todoList['task']     = array();
        $todoList['order']    = array();
        $todoList['customer'] = array();

        $this->view->title      = $this->lang->todo->calendar;
        $this->view->date       = $date;
        $this->view->data       = $this->todo->getCalendarData($date);
        $this->view->todoList   = $todoList;
        $this->view->moduleMenu = commonModel::createModuleMenu($this->moduleName);
        $this->display();
    }

    /**
     * browse todos.
     * 
     * @param  string $mode 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function browse($mode = 'assignedTo', $orderBy = 'date_asc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $this->session->set('todoList', $this->app->getURI(true));

        if($mode == 'future')
        {
            $todos = $this->todo->getList('self', $this->app->user->account, 'future', 'unclosed', $orderBy, $pager);
        }
        else if($mode == 'all')
        {
            $todos = $this->todo->getList('self', $this->app->user->account, 'all', 'all', $orderBy, $pager);
        }
        else if($mode == 'undone')
        {
            $todos = $this->todo->getList('self', $this->app->user->account, 'before', 'undone', $orderBy, $pager);
        }
        else
        {
            $todos = $this->todo->getList($mode, $this->app->user->account, 'all', 'unclosed', $orderBy, $pager);
        }

        $this->view->title      = $this->lang->todo->browse;
        $this->view->todos      = $todos;
        $this->view->users      = $this->loadModel('user')->getPairs();
        $this->view->mode       = $mode;
        $this->view->orderBy    = $orderBy;
        $this->view->pager      = $pager;
        $this->view->moduleMenu = commonModel::createModuleMenu($this->moduleName);
        $this->display();
    }

    /**
     * Create a todo.
     * 
     * @param  string|date $date 
     * @param  string      $account 
     * @access public
     * @return void
     */
    public function create($date = 'today', $account = '')
    {
        if($date == 'today') $date = date::today();
        if($account == '')   $account = $this->app->user->account;
        if(!empty($_POST))
        {
            $todoID = $this->todo->create($date, $account);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->loadModel('action')->create('todo', $todoID, 'created');
            $date = str_replace('-', '', $this->post->date);
            if($date == '')
            {
                $date = 'future'; 
            }
            else if($date == date('Ymd'))
            {
                $date = 'today'; 
            }
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => $this->createLink('todo', 'calendar', "date=$date")));
        }

        $this->view->title      = $this->lang->todo->common . $this->lang->colon . $this->lang->todo->create;
        $this->view->date       = strftime("%Y-%m-%d", strtotime($date));
        $this->view->times      = date::buildTimeList($this->config->todo->times->begin, $this->config->todo->times->end, $this->config->todo->times->delta);
        $this->view->time       = date::now();
        $this->display();      
    }

    /**
     * Batch create todo
     * 
     * @param  string $date 
     * @access public
     * @return void
     */
    public function batchCreate($date = 'today')
    {
        if($date == 'today') $date = date(DT_DATE1, time());
        if(!empty($_POST))
        {
            $this->todo->batchCreate();
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            /* Locate the browser. */
            $date = str_replace('-', '', $this->post->date);
            if($date == '')
            {
                $date = 'future'; 
            }
            else if($date == date('Ymd'))
            {
                $date= 'today'; 
            }
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => $this->createLink('todo', 'calendar', "date=$date")));
        }

        $this->view->title = $this->lang->todo->common . $this->lang->colon . $this->lang->todo->batchCreate;
        $this->view->date  = (int)$date == 0 ? $date : date('Y-m-d', strtotime($date));
        $this->view->times = date::buildTimeList($this->config->todo->times->begin, $this->config->todo->times->end, $this->config->todo->times->delta);
        $this->view->time  = date::now();
        $this->view->users = $this->loadModel('user')->getPairs('noclosed,nodeleted');
        $this->view->modalWidth = '85%';

        $this->display();
    }

    /**
     * Edit a todo.
     * 
     * @param  int    $todoID 
     * @access public
     * @return void
     */
    public function edit($todoID, $comment = false)
    {
        /* Judge a private todo or not, If private, die. */
        $todo = $this->todo->getById($todoID);
        $this->checkPriv($todo, 'edit');

        if(!empty($_POST))
        {
            $changes = array();
            if($comment == false)
            {
                $changes = $this->todo->update($todoID);
                if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            }

            if($this->post->comment != '' or !empty($changes))
            {
                $actionID = $this->loadModel('action')->create('todo', $todoID, 'edited', $this->post->comment);
                $this->action->logHistory($actionID, $changes);
            }
            $date = str_replace('-', '', $this->post->date);
            if(!$comment) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'closeModal' => 'true', 'locate' => 'reload'));
            if($comment)  $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => 'loadInModal'));
        }
       
        if($todo->date != '00000000') $todo->date = strftime("%Y-%m-%d", strtotime($todo->date));
        $this->view->title      = $this->lang->todo->edit;
        $this->view->position[] = $this->lang->todo->common;
        $this->view->position[] = $this->lang->todo->edit;
        $this->view->times      = date::buildTimeList($this->config->todo->times->begin, $this->config->todo->times->end, $this->config->todo->times->delta);
        $this->view->todo       = $todo;
        $this->display();
    }

    /**
     * View a todo. 
     * 
     * @param  int    $todoID 
     * @param  string $from     my|company
     * @access public
     * @return void
     */
    public function view($todoID, $from = 'company')
    {
        $todo = $this->todo->getById($todoID, true);
        $this->checkPriv($todo, 'view');
        if(!$todo) $this->locate($this->createLink('todo', 'calendar'));

        /* Save session for back to this app. */
        if($todo->type == 'task')     $this->session->set('taskList', "javascript:$.openEntry(\"dashboard\")");
        if($todo->type == 'order')    $this->session->set('orderList', "javascript:$.openEntry(\"dashboard\")");
        if($todo->type == 'customer') $this->session->set('customerList', "javascript:$.openEntry(\"dashboard\")");

        $this->view->title      = "{$this->lang->todo->common} #$todo->id $todo->name";
        $this->view->modalWidth = '80%';
        $this->view->todo       = $todo;
        $this->view->times      = date::buildTimeList($this->config->todo->times->begin, $this->config->todo->times->end, $this->config->todo->times->delta);
        $this->view->users      = $this->loadModel('user')->getPairs('noletter');
        $this->view->actions    = $this->loadModel('action')->getList('todo', $todoID);
        $this->view->from       = $from;

        $this->display();
    }

    /**
     * Delete a todo.
     * 
     * @param  int    $todoID 
     * @access public
     * @return void
     */
    public function delete($todoID)
    {
        $todo = $this->todo->getByID($todoID);
        $this->checkPriv($todo, 'delete', 'json');
        $date = str_replace('-', '', $todo->date);
        if($date == '00000000') $date = '';

        $this->dao->delete()->from(TABLE_TODO)->where('id')->eq($todoID)->exec();
        $this->loadModel('action')->create('todo', $todoID, 'deleted');
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success'));
    }

    /**
     * Close a todo.
     * 
     * @param  int    $todoID 
     * @access public
     * @return void
     */
    public function close($todoID)
    {
        $todo = $this->todo->getById($todoID);
        $this->checkPriv($todo, 'close', 'json');

        if($todo->status == 'done') $this->todo->close($todoID);
        $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
    }

    /**
     * batch close todos. 
     * 
     * @access public
     * @return void
     */
    public function batchClose()
    {
        $todoIDList = $this->post->todoIDList ? $this->post->todoIDList : array();
        foreach($todoIDList as $todoID)
        {
            $todo = $this->todo->getById($todoID);
            if($this->todo->checkPriv($todo, 'close') and $todo->status == 'done') $this->todo->close($todoID);
        }

        $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => 'reload'));
    }

    /**
     * Activate a todo.
     * 
     * @param  int    $todoID 
     * @access public
     * @return void
     */
    public function activate($todoID)
    {
        $todo = $this->todo->getById($todoID);
        $this->checkPriv($todo, 'activate', 'json');

        if($todo->status == 'closed') $this->todo->activate($todoID);
        $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
    }

    /**
     * Finish a todo.
     * 
     * @param  int    $todoID 
     * @access public
     * @return void
     */
    public function finish($todoID)
    {
        $todo = $this->todo->getById($todoID);
        $this->checkPriv($todo, 'finish', 'json');
        if(strpos('done,closed', $todo->status) === false) $this->todo->finish($todoID);

        if($todo->type == 'task') 
        {
            $task = $this->loadModel('task')->getById($todo->idvalue);
            $_POST['consumed'] = $task->left == 0 ? 1 : $task->left;
            $changes = $this->loadModel('task')->finish($todo->idvalue);
            if(!empty($changes))
            {
                $actionID = $this->loadModel('action')->create('task', $todo->idvalue, 'Finished');
                $this->action->logHistory($actionID, $changes);
            }
        }
        if($todo->type == 'order' or $todo->type == 'customer')
        {
            $entry = 'crm';
            $confirmNote = sprintf($this->lang->todo->confirmTip, $this->lang->{$todo->type}->common, $todo->id);
            $confirmURL  = $this->createLink("{$entry}.{$todo->type}", 'view', "id=$todo->idvalue", 'html');
            $this->send(array('result' => 'success', 'confirm' => array('note' => $confirmNote, 'url' => $confirmURL, 'entry' => $entry)));
        }
        $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
    }

    /**
     * Assign one todo to someone. 
     * 
     * @param  int    $todoID 
     * @access public
     * @return void
     */
    public function assignTo($todoID)
    {
        $todo = $this->todo->getById($todoID);
        $this->checkPriv($todo, 'assignTo');

        if($_POST)
        {
            $changes = $this->todo->assignTo($todoID);
            if(!empty($changes))
            {
                $actionID = $this->loadModel('action')->create('todo', $todo->id, 'Assigned', '', $this->post->assignedTo);
                $this->action->logHistory($actionID, $changes);
                $this->sendmail($todoID, $actionID);
            }
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'closeModal' => 'true', 'locate' => 'reload'));
        }

        if($todo->date != '00000000') $todo->date = strftime("%Y-%m-%d", strtotime($todo->date));
        $this->view->title = $this->lang->todo->assignTo;
        $this->view->todo  = $todo;
        $this->view->users = $this->loadModel('user')->getPairs('nodeleted,noclosed');
        $this->view->times = date::buildTimeList($this->config->todo->times->begin, $this->config->todo->times->end, $this->config->todo->times->delta);
        $this->display();
    }

    /**
     * Import selected todoes to today.
     * 
     * @access public
     * @return void
     */
    public function import2Today($todoID = 0)
    {
        $todoIDList = $_POST ? $this->post->todoIDList : array($todoID);
        $date       = !empty($_POST['date']) ? $_POST['date'] : date::today();
        $this->dao->update(TABLE_TODO)->set('date')->eq($date)->where('id')->in($todoIDList)->exec();
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success', 'locate' => $this->session->todoList));
    }

    /**
     * Send email.
     * 
     * @param  int    $todoID 
     * @param  int    $actionID 
     * @access public
     * @return void
     */
    public function sendmail($todoID, $actionID)
    {
        /* Reset $this->output. */
        $this->clear();

        /* Get action info. */
        $action          = $this->loadModel('action')->getById($actionID);
        $history         = $this->action->getHistory($actionID);
        $action->history = isset($history[$actionID]) ? $history[$actionID] : array();

        /* Set toList. */
        $todo    = $this->todo->getById($todoID);
        $users   = $this->loadModel('user')->getPairs('noletter');
        $toList  = $todo->assignedTo;
        $subject = "{$this->lang->todo->common}#{$todo->id}{$this->lang->colon}{$todo->name}";

        /* send notice if user is online and return failed accounts. */
        $toList = $this->loadModel('action')->sendNotice($actionID, $toList);

        /* Create the email content. */
        $this->view->todo   = $todo;
        $this->view->action = $action;
        $this->view->users  = $users;

        $mailContent = $this->parse($this->moduleName, 'sendmail');

        /* Send emails. */
        $this->loadModel('mail')->send($toList, $subject, $mailContent);
        if($this->mail->isError()) trigger_error(join("\n", $this->mail->getError()));
    }

    /**
     * Check privilage. 
     * 
     * @param  obejct $todo 
     * @param  string $action 
     * @param  string $errorType   html|json
     * @access public
     * @return bool
     */
    public function checkPriv($todo, $action, $errorType = '')
    {
        if(!$this->todo->checkPriv($todo, $action))
        {
            if($errorType == '') $errorType = empty($_POST) ? 'html' : 'json';
            if($errorType == 'json')
            {
                $this->app->loadLang('error');
                $this->send(array('result' => 'fail', 'message' => $this->lang->error->typeList['accessLimited']));
            }
            else
            {
                $locate = helper::safe64Encode($this->server->http_referer);
                $errorLink = helper::createLink('error', 'index', "type=accessLimited&locate={$locate}");
                $this->locate($errorLink);
            }
        }
        return true;
    }

    /**
     * AJAX: get actions of a todo. for web app.
     * 
     * @param  int    $todoID 
     * @access public
     * @return void
     */
    public function ajaxGetDetail($todoID)
    {
        $this->view->actions = $this->loadModel('action')->getList('todo', $todoID);
        $this->display();
    }
}
