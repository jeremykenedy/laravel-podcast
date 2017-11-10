<div class="modal fade modal-primary" id="add_podast_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a new podcast feed</h4>
            </div>
            {!! Form::model($podcast = new \App\Podcast, ['method' =>'POST','action' => ['PodcastsController@store']]) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {{ Form::label('feed_url', 'Enter the Podcast Feed Url') }}
                        {!! Form::text('feed_url', 'http://feeds.feedburner.com/TheGreatestGeneration', ['class' => 'form-control','required','placeholder' => 'Enter a Podcast Feed Url here: http://feeds.feedburner.com/TheGreatestGeneration']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> Cancel', array('class' => 'btn btn-default pull-left', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
                    {!! Form::button('<i class="fa fa-fw fa-plus" aria-hidden="true"></i> Add Feed', array('class' => 'btn btn-primary pull-right', 'type' => 'submit', 'id' => 'confirm' )) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>