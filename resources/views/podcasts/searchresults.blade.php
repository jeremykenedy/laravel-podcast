@extends('layouts.app')

@section('template_title')
  Search Results
@endsection

@section('content')

	@if($items)
    @include('podcasts.player')
	@endif

	<div class="container container-podcast-list">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <h3 class="page-title">
          Search Results
        </h3>
        <hr/>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        @if($items)
        	@foreach ($items as $item)
            @include('podcasts.item')
        	@endforeach
      	@endif
      </div>
    </div>
  </div>

@endsection

@section('footer-scripts')
  @include('scripts.podcast-scripts')
@endsection