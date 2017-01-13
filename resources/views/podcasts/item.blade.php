<div class="row podcast-item-row">
  <div class="col-sm-3 podcast-thumbnail-container">
    <img class="podcast-thumbnail" width="100" height="100" src="{{asset(App\PodcastItem::find($item->id)->podcast->feed_thumbnail_location)}}" alt="{{App\PodcastItem::find($item->id)->podcast->name}}"/>
    <p>
      <small>
        {{ date_format(date_create($item->published_at),'jS M Y') }}
      </small>
    </p>
  </div>
  <div class="col-sm-9">
    <h4 class="podcast-title">
      <small>
        {{App\PodcastItem::find($item->id)->podcast->name}}
      </small>
    </h4>
    <h3 class="podcast-item-title">
      {{-- <a target="_blank" href="{{ $item->url }}"> --}}
        {{ $item->title }}
      {{-- </a> --}}
    </h3>
    <p class="podcast-item-description">
      {{ $item->description }}
      <br/><br/>
      {{--
        <a class="read-more" target="_blank" href="{{ $item->url }}"><small>Read More</small></a>
      --}}
    </p>
    <div class="player-action-list">
        <ul class="list-inline">
            <li class='play' data-src='{{ $item->audio_url}}' data-toggle="tooltip" data-placement="bottom" title="Play">
              <i class="fa fa-fw fa-play" aria-hidden="true"></i>
              <span class="sr-only">Play</span>
            </li>
            <li class="mark-as-favorite" data-src="{{$item->id}}" data-title="{{$item->title}}" data-toggle="tooltip" data-placement="bottom" title="Mark as ">
              @if($item->is_mark_as_favorite)
                <i class="fa fa-fw fa-heart" aria-hidden="true"></i>
                <span class="sr-only">Marked as Favorite</span>
              @else
                <i class="fa fa-fw fa-heart fa-heart-o" aria-hidden="true"></i>
                <span class="sr-only">Not Marked as Favorite</span>
              @endif
            </li>

            <li class="mark-as-read" data-toggle="modal" data-target="#confirmRead" data-src="{{$item->id}}" data-title="{{$item->title}}" title="Mark as Read">
              <span data-toggle="tooltip" data-placement="bottom" title="Mark as Read">
                <i class="fa fa-check" aria-hidden="true"></i>
                <span class="sr-only">Mark as read</span>
              </span>
            </li>

            <li class="mark-all-prev-read" data-toggle="modal" data-target="#confirmAllRead" data-src="{{$item->id}}" data-title="{{$item->title}}" title="Mark all previous as read">
              <span class="fa-stack" data-toggle="tooltip" data-placement="bottom" title="Mark all previous as read">
                  <i class="fa fa-check fa-stack-1x" style="margin-left:2px" aria-hidden="true"></i>
                  <i class="fa fa-check fa-inverse fa-stack-1x" style="margin-left:-3px;" aria-hidden="true"></i>
                  <i class="fa fa-check  fa-stack-1x" style="margin-left:-4px" aria-hidden="true"></i>
                  <span class="sr-only">Mark all previous as read</span>
              </span>
            </li>
            <li class='download'>
              <a href='{{ $item->audio_url}}' download='{{ $item->audio_url}}' data-toggle="tooltip" data-placement="bottom" title="Download">
                <i class="fa fa-fw fa-cloud-download" aria-hidden="true"></i>
                <span class="sr-only">Download</span>
              </a>
            </li>
        </ul>
    </div>
  </div>
</div>

@include('modals.modal-markRead')
@include('modals.modal-markAllRead')