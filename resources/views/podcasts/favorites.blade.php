@extends('layouts.app')

@section('template_title')
  Favorites
@endsection

@section('template_body_classes')
    bg6
@endsection

@section('content')
  @if($podcastItems)
    @include('podcasts.player')
  @endif
  <div class="main container container-podcast-list favorites">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <h3 class="page-title">
            Favorite Podcasts
        </h3>
        <hr/>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        @if($podcastItems)

          @foreach ($podcastItems as $item)
            @include('podcasts.item')
          @endforeach

          {{ $podcastItems->render() }}

      	@endif

        @if (count($podcastItems) === 0)
            <p>You have not favorited any podcasts</p>
        @endif
      </div>
    </div>
  </div>
@endsection

@section('footer-scripts')
  @include('scripts.podcast-scripts')
@endsection