@extends('layouts.app')

@section('template_title')
  Manage Podcasts
@endsection

@section('header-style')
@endsection

@section('template_body_classes')
    bg5
@endsection

@section('content')
    <div class="container main container-podcast-manage">
        <div class="row">
            <div class="col-md-12">
                <span data-toggle="modal" data-target="#add_podast_modal" class="btn-add-podcast">
                    <a href="#" class="pull-right" data-toggle="tooltip" data-placement="left" title="Add a new podcast feed">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle-thin fa-stack-2x" aria-hidden="true"></i>
                            <i class="fa fa-plus fa-stack-1x" aria-hidden="true"></i>
                        </span>
                    </a>
                </span>
                <h3 class="page-title">
                    Manage Podcast Feeds
                </h3>
                <hr/>
                @include('partials.form-status')
            </div>
        </div>
        <div class="row">
            @if($podcasts->count() > 0)
                @foreach($podcasts as $cast)
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="podcast-container">
                            <span class="podcast-added-on">Added on {{ date('F d, Y', strtotime($cast->created_at)) }}</span>

                            <h4 class="podcast-title">{{$cast->name}}</h4>

                            <p>
                                {{-- <a target="_blank" href="{{$cast->web_url}}"> --}}
                                    <img class="podcast-thumbnail" width="100" height="100" src="{{asset($cast->feed_thumbnail_location)}}" />
                                {{-- </a> --}}
                            </p>

                            <div class="podcast-action-list">
                                <ul class="list-inline">
                                    <li class='feed-delete' data-toggle="tooltip" data-placement="top" title="Delete podcast feed">
                                        {!! Form::open(array('url' => 'podcasts/' . $cast->id)) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button('<i class="fa fa-remove fa-fw" aria-hidden="true"></i> Delete', array('class' => 'btn btn-delete','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Podcast', 'data-message' => 'Are you sure you want to delete this podcast ?')) !!}
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    @include('modals.modal-add')
    @include('modals.modal-delete')

@endsection

@section('footer-scripts')
    @include('scripts.delete-modal-script')
    @include('scripts.add-modal-script')
@endsection