
<style>
*{
    color:black;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#EntryShow").change(function() {
	     this.form.submit();
	});

	var entryId = 0;
	$("button#send").click(function() {
		$(".modal-body").hide();
		$(".modal-footer").hide();
		$(".modal-ajax").show();
		$.ajax({
			type: "POST",
			url: '<?php echo $this->Html->url(array("controller" => "entries", "action" => "email")); ?>/' + entryId,
			data: $('form#emailSubmit').serialize(),
				success: function(response) {
					msg = JSON.parse(response); console.log(msg);
					if (msg['status'] == 'success') {
						$(".modal-error-msg").html("");
						$(".modal-error-msg").hide();
						$(".modal-body").show();
						$(".modal-footer").show();
						$(".modal-ajax").hide();
						$("#emailModal").modal('hide');
					} else {
						$(".modal-error-msg").html(msg['msg']);
						$(".modal-error-msg").show();
						$(".modal-body").show();
						$(".modal-footer").show();
						$(".modal-ajax").hide();
					}
				},
				error: function() {
					$(".modal-error-msg").html("Error sending email.");
					$(".error-msg").show();
					$(".modal-body").show();
					$(".modal-footer").show();
					$(".modal-ajax").hide();
				}
		});
	});

	$('#emailModal').on('show.bs.modal', function(e) {
		$(".modal-error-msg").html("");
		$(".modal-ajax").hide();
		$(".modal-error-msg").hide();
		entryId = $(e.relatedTarget).data('id');
		var entryType = $(e.relatedTarget).data('type');
		var entryNumber = $(e.relatedTarget).data('number');
		$("#emailModelType").html(entryType);
		$("#emailModelNumber").html(entryNumber);
	});
});
</script>

<div class="row">
	<div class="btn-group col-md-4">
		<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
			<?php echo  __d('webzash', 'Add Entry'); ?>&nbsp;
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu">
		<?php
			foreach (Configure::read('Account.ET') as $entrytype) {
				echo '<li>' . $this->Html->link($entrytype['name'], array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'add', $entrytype['label'])) . '</li>';
			}
		?>
		</ul>
	</div>

	<div class="col-md-3">
		<?php
			$options = array();
			$options['0'] = 'All';
			foreach (Configure::read('Account.ET') as $entrytype) {
				$options[h($entrytype['label'])] = h($entrytype['name']);
			}
		?>
		<?php echo $this->Form->create('Entry'); ?>
		<?php echo $this->Form->input('show', array('type' => 'select', 'options' => $options, 'label' => false, 'before' => '<div class="pull-left" id="show-label">' . __d('webzash', 'Show') . '</div>', 'div' => false)); ?>
		<?php echo $this->Form->end(__d('webzash', '')); ?>
	</div>
</div>
<br />
<table class="stripped">

<tr>
<th><?php echo $this->Paginator->sort('date', __d('webzash', 'Date')); ?></th>
<th><?php echo $this->Paginator->sort('number', __d('webzash', 'Number')); ?></th>
<th><?php echo __d('webzash', 'Ledger'); ?></th>
<th><?php echo $this->Paginator->sort('entrytype_id', __d('webzash', 'Type')); ?></th>
<th><?php echo $this->Paginator->sort('tag_id', __d('webzash', 'Tag')); ?></th>
<th><?php echo $this->Paginator->sort('dr_total', __d('webzash', 'Debit Amount') . ' (' . Configure::read('Account.currency_symbol') . ')'); ?></th>
<th><?php echo $this->Paginator->sort('cr_total', __d('webzash', 'Credit Amount') . ' (' . Configure::read('Account.currency_symbol') . ')'); ?></th>
<th><?php echo __d('webzash', 'Actions'); ?></th>
</tr>

<?php
foreach ($entries as $entry) {
	$entryTypeName = Configure::read('Account.ET.' . $entry['Entry']['entrytype_id'] . '.name');
	$entryTypeLabel = Configure::read('Account.ET.' . $entry['Entry']['entrytype_id'] . '.label');
	echo '<tr valign="top">';
	echo '<td>' . dateFromSql($entry['Entry']['date']) . '</td>';
	echo '<td>' . h(toEntryNumber($entry['Entry']['number'], $entry['Entry']['entrytype_id'])) . '</td>';

	echo '<td>';
	echo $this->Generic->entryLedgers($entry['Entry']['id'], 0);
	if (strlen($entry['Entry']['narration']) > 0) {
		if (strlen($entry['Entry']['narration']) > 60) {
			echo $this->Html->tag('span', substr(h($entry['Entry']['narration']), 0, 60) . '...', array('class' => 'text-small'));
		} else {
			echo $this->Html->tag('span', substr(h($entry['Entry']['narration']), 0, 60), array('class' => 'text-small'));
		}
	}
	echo '</td>';

	echo '<td>' . h($entryTypeName) . '</td>';
	echo '<td>' . $this->Generic->showTag($entry['Entry']['tag_id']) . '</td>';
	echo '<td>' . toCurrency('D', $entry['Entry']['dr_total']) . '</td>';
	echo '<td>' . toCurrency('C', $entry['Entry']['cr_total']) . '</td>';

	echo '<td>';

	/* View */
	echo $this->Html->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-log-in')) . __d('webzash', ' View'), array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'view', h($entryTypeLabel), $entry['Entry']['id']), array('class' => 'no-hover', 'escape' => false));
	echo $this->Html->tag('span', '', array('class' => 'link-pad'));
	/* Edit */
	echo $this->Html->link($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-edit')) . __d('webzash', ' Edit'), array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'edit', h($entryTypeLabel), $entry['Entry']['id']), array('class' => 'no-hover', 'escape' => false));
	echo $this->Html->tag('span', '', array('class' => 'link-pad'));
	/* Delete */
	echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')) . __d('webzash', ' Delete'), array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'delete', h($entryTypeLabel), $entry['Entry']['id']), array('class' => 'no-hover', 'escape' => false, 'confirm' => __d('webzash', 'Are you sure you want to delete the entry ?')));
	echo $this->Html->tag('span', '', array('class' => 'link-pad'));
	/* Email */
	echo '<a href="#" data-toggle="modal" data-id="' . $entry['Entry']['id'] . '" data-type="' . h($entryTypeName) . '" data-number="' . h(toEntryNumber($entry['Entry']['number'], $entry['Entry']['entrytype_id'])) . '" data-target="#emailModal">' . $this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-envelope')) . '</a>';
	echo $this->Html->tag('span', '', array('class' => 'link-pad'));
	/* Download */
	echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-download-alt')), array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'download', $entry['Entry']['id']), array('class' => 'no-hover', 'escape' => false));
	echo $this->Html->tag('span', '', array('class' => 'link-pad'));
	/* Print */
	echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-print')), '', array('escape' => false, 'onClick' => "window.open('" . $this->Html->url(array('controller' => 'entries', 'action' => 'printpreview', $entry['Entry']['id'])) . "', 'windowname','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=600'); return false;"));

	echo '</td>';

	echo '</tr>';
}
?>
</table>

<div class="text-center paginate">
	<ul class="pagination">
		<?php
			echo $this->Paginator->first(__d('webzash', 'first'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
	                echo $this->Paginator->prev(__d('webzash', 'prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
	                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
			echo $this->Paginator->next(__d('webzash', 'next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			echo $this->Paginator->last(__d('webzash', 'last'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		?>
	</ul>
</div>

<!-- email modal -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="emailSubmit" name="emailSubmit">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h4 class="modal-title" id="myModalLabel">Email <span id="emailModelType"></span> Entry Number "<span id="emailModelNumber"></span>"</h4>
			</div>
			<div class="modal-error-msg"></div>
			<div class="modal-body">
				<?php echo $this->Form->input('email', array('type' => 'email', 'label' => __d('webzash', 'Email to'), 'class' => 'form-control')); ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="send">Send</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
			<div class="modal-ajax">Please wait, sending email...</div>
			</form>
		</div>
	</div>
</div>
