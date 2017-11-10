<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PodcastItem;
use Auth;

class PodcastItemsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * [markAsRead mark a podcast item as read]
     * @return array
     */
    public function markAsRead(Request $request) {
        $result['status'] = 0;
        $result['message'] = 'Something went wrong, please try again';

        $podcastItemId = trim(strip_tags($request->itemId));

        $item = DB::table('podcast_items')->select('user_id')
                                  ->where('user_id', '=', Auth::user()->id)
                                  ->where('id', '=', $podcastItemId)
                                  ->first();

        // if item with id exists in DB and is owned by the authenticated user
        if ($item) {
            $podcastItem = PodcastItem::findOrFail($podcastItemId);
            $podcastItem->is_mark_as_read = 1;
            $podcastItem->save();
            $result['status'] = 1;
            $result['message'] = 'Marked as read';
        }
        return $result;
    }

    /**
     * [markAllPrevAsRead mark all previous item in a podcast as read]
     * @return array
     */
    public function markAllPrevAsRead(Request $request) {
        $result['status'] = 0;
        $result['message'] = 'Something went wrong, please try again';

        $podcastItemId = trim(strip_tags($request->itemId));

        $item = DB::table('podcast_items')->select('published_at', 'podcast_id')
                                  ->where('user_id', '=', Auth::user()->id)
                                  ->where('id', '=', $podcastItemId)
                                  ->first();
        if ($item) {
            $items = DB::table('podcast_items')
                ->select('id', 'published_at')
                ->where('user_id', '=', Auth::user()->id)
                ->where('podcast_id', '=', $item->podcast_id)
                ->where('is_mark_as_read', '!=', 1)
                ->where('published_at', '<', $item->published_at)
                ->get();

            $podcastItemIds = [];

            foreach ($items as $record) {
                $record = PodcastItem::findOrFail($record->id);
                $record->is_mark_as_read = 1;
                $record->save();

                array_push($podcastItemIds, $record->id);
            }

            // @todo need to limit the item ids sent to 15 (descending order)

            $result['status'] = 1;
            $result['data'] = $podcastItemIds;
            $result['message'] = 'Previous items in this podcast has been marked as read';
        }
        return $result;
    }

    /**
     * [markAsFavorite mark a podcast item as favorite]
     * @return array
     */
    public function markAsFavorite(Request $request) {

        $result['status'] = 0;
        $result['message'] = 'Something went wrong, please try again';

        $podcastitemId = trim(strip_tags($request->itemId));

        $item = DB::table('podcast_items')->select('user_id')
            ->where('user_id', '=', Auth::user()->id)
            ->where('id', '=', $podcastitemId)
            ->first();

        // if item with id exists in DB and is owned by the authenticated user
        if ($item) {
            $podcastItem = PodcastItem::findOrFail($podcastitemId);
            $result['currentValue'] = !$podcastItem->is_mark_as_favorite;
            $podcastItem->is_mark_as_favorite = !$podcastItem->is_mark_as_favorite; // opposite of current value
            $podcastItem->save();

            $result['status'] = 1;
            $result['message'] = 'Favorite Updated';
        }
        return $result;
    }

    /**
     * Return a view to display item search results for a given query
     */

    public function search(Request $request) {

        $query = trim(strip_tags($request->query('query')));
        $items = DB::table('podcast_items')
            ->where('title', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->get();

        return view('podcasts.searchresults')->with([
            'items' => $items,
            'query' => $query,
        ]);
    }

}
