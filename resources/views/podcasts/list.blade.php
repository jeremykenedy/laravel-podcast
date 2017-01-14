@extends('layouts.app')

@section('template_title')
  Listen
@endsection

@section('content')
  @if($podcast_items)
    @include('podcasts.player')
  @endif
  <div class="container container-podcast-list">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <h3 class="page-title">
          My Podcast List
        </h3>
        <hr/>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        @if($podcast_items)
          @foreach ($podcast_items as $item)
            @include('podcasts.item')
          @endforeach
          <div class="row container-fluid">
            {{ $podcast_items->render() }}
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection

@section('footer-scripts')
  @include('scripts.podcast-scripts')
@endsection