<?php
  add_stylesheet_to_page('project/task_list.css');
  $task_list_options = array();
  if ($task_list->canEdit(logged_user())) {
    $task_list_options[] = '<a href="' . $task_list->getEditUrl() . '">' . lang('edit') . '</a>';
  } // if
  if (ProjectTaskList::canAdd(logged_user(), active_project())) {
    $task_list_options[] = '<a href="' . $task_list->getCopyUrl() . '">' . lang('copy') . '</a>';
    $task_list_options[] = '<a href="' . $task_list->getMoveUrl() . '">' . lang('move') . '</a>';
  } // if
  if ($task_list->canDelete(logged_user())) {
    $task_list_options[] = '<a href="' . $task_list->getDeleteUrl() . '">' . lang('delete') . '</a>';
  } // if
  if ($task_list->canReorderTasks(logged_user())) {
    $task_list_options[] = '<a href="' . $task_list->getReorderTasksUrl($on_list_page) . '">' . lang('reorder tasks') . '</a>';
    $can_reorder_tasks = true;
  } else {
    $can_reorder_tasks = false;
  }// if

  if ($cc = $task_list->countComments()) {
    $task_list_options[] = '<span><a href="'. $task_list->getViewUrl() .'#objectComments">'. lang('comments') .'('. $cc .')</a></span>';
  }
  $task_list_options[] = '<span><a href="'. $task_list->getDownloadUrl() .'">'. lang('download') . '</a></span>';
?>

<div class="taskList">
  <div class="block" id="taskList<?php echo $task_list->getId() ?>">

    <div class="header"><a href="<?php echo $task_list->getViewUrl() ?>"><?php echo clean($task_list->getName()) ?></a>
      <?php $this->includeTemplate(get_template_path('view_progressbar', 'task')); ?>

      <?php if ($task_list->isPrivate()): ?>
        <div class="private" title="<?php echo lang('private task list') ?>">
          <span><?php echo lang('private task list') ?></span>
        </div>
      <?php endif ?>

    </div>

    <?php if (!is_null($task_list->getDueDate())) : ?>
    <div class="dueDate"><span><?php echo lang('due date') ?>:</span> <?php echo ($task_list->getDueDate()->getYear() > DateTimeValueLib::now()->getYear()) ? format_date($task_list->getDueDate(), null, 0) : format_descriptive_date($task_list->getDueDate(), 0) ?></div>
    <?php endif ?>

    <?php if ($task_list->getDescription()): ?>
    <div class="desc"><?php echo (do_textile($task_list->getDescription())) ?></div>
    <?php endif ?>

    <?php if (plugin_active('tags')): ?>
    <div class="taskListTags"><span><?php echo lang('tags') ?>:</span> <?php echo project_object_tags($task_list, $task_list->getProject()) ?></div>
    <?php endif ?>

    <?php if (count($task_list_options)): ?>
    <div class="options"><?php echo implode(' | ', $task_list_options) ?></div>
    <?php endif ?>

    <?php if (is_array($task_list->getOpenTasks())): ?>
    <div class="openTasks">
      <ul id="<?php echo $task_list->getId() ?>"><!--table class="blank"-->
        <?php foreach ($task_list->getOpenTasks() as $task): ?>
        <li id="<?php echo $task->getId() ?>" class="<?php odd_even_class($task_list_ln) ?>"><!--tr class="<?php odd_even_class($task_list_ln); ?>"-->
          <!-- Task text and options -->
          <!--td class="taskText"-->
            <div class="task-text">
            <?php echo $task->getText() ?>
            <?php if ($task->getAssignedTo()):?>
            <span class="assignedTo"><?php echo clean($task->getAssignedTo()->getObjectName()) ?></span>
            <?php endif ?>
            </div>
            <?php if (!is_null($task->getDueDate())) { ?>
            <div class="dueDate"><span><?php echo lang('due date') ?>:</span> <?php echo ($task->getDueDate()->getYear() > DateTimeValueLib::now()->getYear()) ? format_date($task->getDueDate(), null, 0) : format_descriptive_date($task->getDueDate(), 0) ?></div>
            <?php } // if ?>


            <?php
            $task_options = array();
            if ($can_reorder_tasks) { $task_options[] = '<span class="reorder"><img src="'.get_image_url('icons/arrow-sort.png').'" /></span>'; }
            if ($task->canEdit(logged_user())) {
              $task_options[] = '<a href="' . $task->getEditUrl() . '"><img width="16" height="16" src="' . get_image_url('icons/pencil.png') . '" alt="'.lang('edit') .'" title="'.lang('edit').'" /></a>';
            } // if
            if ($task->canDelete(logged_user())) {
              $task_options[] = '<a href="' . $task->getDeleteUrl() . '"><img src="'.get_image_url('icons/delete.png'). '" alt="'. lang('delete') . '" title="'.lang('delete').'" /></a>';
            } // if
            if ($task->canView(logged_user())) {
              $task_options[] = '<a href="' . $task->getViewUrl($on_list_page) . '"><img src="'.get_image_url('icons/comment_add.png').'" alt="' . lang('view') . '" title="" /></a>';
            } // if
            if ($cc = $task->countComments()) {
              $task_options[] = '<a href="' . $task->getViewUrl() .'#objectComments">'. lang('comments') .'('. $cc .')</a>';
            }
            if ($task->canChangeStatus(logged_user())) {
              if ($task->isOpen()) {
                $task_options[] = '<a href="' . $task->getCompleteUrl() . '"><img src="'.get_image_url('icons/tick.png'). '" alt="' . lang('mark task as completed') . '" title="'.lang('mark task as completed').'" /></a>';
              } else {
                $task_options[] = '<span>' . lang('open task') . '</span>';
              } // if
            } // if
            ?>
            <?php if (count($task_list_options)): ?>
              <div class="options"><?php echo implode(' | ', $task_options) ?></div>
            <?php endif ?>
          <!--/td-->
        </li><!--/tr-->
        <?php endforeach ?>
      </ul><!--/table-->
    </div>
    <?php else: ?>
    <?php echo lang('no open task in task list') ?>
    <?php endif ?>
    <?php if ($task_list->canAddTask(logged_user())): ?>
    <div class="add-task-box">
      <div class="add-task-link"><a href="javascript:void(0)"><?php echo lang('add task') ?></a></div>
    </div>
    <?php endif ?>
    <?php if (is_array($task_list->getCompletedTasks())) { ?>
    <div class="completedTasks">
      <?php echo $on_list_page ? lang('completed tasks') : lang('recently completed tasks') ?>:
      <table class="blank">
        <?php define('MAX_COMPLETED_TASKS', 5); $shown_completed_tasks = 0; foreach ($task_list->getCompletedTasks() as $task): if (!$on_list_page && (++$shown_completed_tasks > MAX_COMPLETED_TASKS)) break; ?>
        <tr>
          <td class="taskText">
            <?php echo do_textile($task->getText()) ?> 
            <?php
            $task_options = array();
            if ($task->getCompletedBy()) {
              $task_options[] = '<span class="taskCompletedOnBy">' . lang('completed on by', format_date($task->getCompletedOn()), $task->getCompletedBy()->getCardUrl(), clean($task->getCompletedBy()->getDisplayName())) . '</span>';
            } else {
              $task_options[] = '<span class="taskCompletedOnBy">' . lang('completed on', format_date($task->getCompletedOn())) . '</span>';
            } //if 
            if ($task->canEdit(logged_user())) $task_options[] = '<a href="' . $task->getEditUrl() . '">' . lang('edit') . '</a>';
            if ($task->canDelete(logged_user())) $task_options[] = '<a href="' . $task->getDeleteUrl() . '">' . lang('delete') . '</a>';
            if ($task->canView(logged_user())) $task_options[] = '<a href="' . $task->getViewUrl($on_list_page) . '">' . lang('view') . '</a>';
            if ($cc = $task->countComments()) $task_options[] = '<a href="' . $task->getViewUrl() .'#objectComments">'. lang('comments') .'('. $cc .')</a>';
            if ($task->canChangeStatus(logged_user())) {
                $task_options[] = '<a href="' . $task->getOpenUrl() . '">' . lang('mark task as open') . '</a>';
            } else {
                $task_options[] = '<span>' . lang('completed task') . '</span>';
            } // if
            ?>
            <?php if (count($task_list_options)): ?>
            <div class="options"><?php echo implode(' | ', $task_options) ?></div>
            <?php endif ?>
          </td>
        </tr>
        <?php endforeach ?>
        <?php if (!$on_list_page && count($task_list->getCompletedTasks()) > 5): ?>
        <tr>
          <td colspan="2"><a href="<?php echo $task_list->getViewUrl() ?>"><?php echo lang('view all completed tasks', $counter) ?></a></td>
        </tr>
        <?php endif ?>
      </table>
    </div>
    <?php } // if ?>
  </div>
</div>
