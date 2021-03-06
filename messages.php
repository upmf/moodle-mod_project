<?php

/*
*
* @package mod-project
* @category mod
* @author Yann Ducruy (yann[dot]ducruy[at]gmail[dot]com). Contact me if needed
* @date 12/06/2015
* @version 3.2
* @license http://www.gnu.org/copyleft/gpl.html GNU Public License
*
*/

    /**
    * Requires and includes
    */
    include_once '../../lib/uploadlib.php';

/// Controller
	if ($work == 'add' || $work == 'update'){
		 include 'edit_message.php';
/// Group operation form *********************************************************

	} elseif ($work == "groupcmd") {
		echo $pagebuffer;
	    $ids = required_param('ids', PARAM_INT);
	    $cmd = required_param('cmd', PARAM_ALPHA);
    ?>
    <center>
    <?php echo $OUTPUT->heading(get_string('groupoperations', 'project')); ?>
    <?php echo $OUTPUT->heading(get_string("group$cmd", 'project'), 'h3'); ?>
    <script type="text/javascript">
    //<![CDATA[
    function senddata(cmd){
        document.forms['groupopform'].work.value="do" + cmd;
        document.forms['groupopform'].submit();
    }
    function cancel(){
        document.forms['groupopform'].submit();
    }
    //]]>
    </script>
    <form name="groupopform" method="get" action="view.php">
    <input type="hidden" name="id" value="<?php p($cm->id) ?>" />
    <input type="hidden" name="work" value="" />
    <input type="button" name="go_btn" value="<?php print_string('continue') ?>" onclick="senddata('<?php p($cmd) ?>')" />
    <input type="button" name="cancel_btn" value="<?php print_string('cancel') ?>" onclick="cancel()" />
    </form>
    </center>
    <?php
	} else {
		if ($work){
			 include 'messages.controller.php';
		}
		echo $pagebuffer;
    ?>
    <script type="text/javascript">
    //<![CDATA[
    function sendgroupdata(){
        document.forms['groupopform'].submit();
    }
    //]]>
    </script>
    <form name="groupopform" method="post" action="view.php">
    <input type="hidden" name="id" value="<?php p($cm->id) ?>" />
    <input type="hidden" name="work" value="groupcmd" />
    <?php
    	project_print_messages($project, $currentGroupId, $cm->id, 0 );
		$context = context_module::instance($cm->id);
        //if ($USER->editmode == 'on') {
        if (has_capability('mod/project:communicate', $context) && $project->etat==0) {
    		echo "<br/><a href='view.php?id={$cm->id}&amp;work=add&amp;parent=0'>".get_string('adddiscu','project')."</a>&nbsp; ";
    		//project_print_group_commands();
    	}
    ?>
    </form>
    <?php
    }
?>