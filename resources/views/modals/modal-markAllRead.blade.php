<div class="modal fade modal-warning" id="confirmAllRead" role="dialog" aria-labelledby="confirmAllReadLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Confirm Mark All as Read</h4>
			</div>
			<div class="modal-body">
				<p>&hellip;</p>
			</div>
			<div class="modal-footer">
				{!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> Cancel', array('class' => 'btn btn-default pull-left', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
				{!! Form::button('<i class="fa fa-fw fa-check" aria-hidden="true"></i> Confirm', array('class' => 'btn btn-warning pull-right', 'type' => 'button', 'id' => 'confirm' )) !!}
			</div>
		</div>
	</div>
</div>