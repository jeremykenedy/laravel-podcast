<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\PodcastItem;
use App\Podcast;
use Auth;
use Feeds;
use Image;

class PodcastsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function show($id) {

        $user = Auth::user();

        $podcast_items = DB::table('podcast_items')
            ->where('user_id', '=', $user->id)
            ->where('is_mark_as_read', '!=', 1)
            ->orderBy('published_at', 'desc')->paginate(15);

        $podcasts = DB::table('podcasts')
            ->where('user_id', '=', $user->id)
            ->get();

        $data = array(
            'podcasts'          => $podcasts,
            'podcast_items'     => $podcast_items,
            'user'              => $user,
        );

        return view('podcasts.list', $data);

    }

    public function index() {

        $user = Auth::user();

        $podcast_items = DB::table('podcast_items')
            ->where('user_id', '=', $user->id)
            ->where('is_mark_as_read', '!=', 1)
            ->orderBy('published_at', 'desc')->paginate(15);

        $podcasts = DB::table('podcasts')
            ->where('user_id', '=', $user->id)
            ->get();

        $data = array(
            'podcasts'          => $podcasts,
            'podcast_items'     => $podcast_items,
            'user'              => $user,
        );

        return view('podcasts.list', $data);

    }

    /**
     * Return a view to manage podcasts
     * @return view
     */
    public function manage() {

        $user = Auth::user();

        $podcasts = DB::table('podcasts')
            ->where('user_id', '=', $user->id)
            ->get();

        $data = array(
            'podcasts'          => $podcasts,
            'user'              => $user,
        );

        return view('podcasts.manage', $data);

    }

    /**
     * Return the list of favorites for a user to a view
     * @return [type] [description]
     */
    public function favorites() {
        $podcastItems = DB::table('podcast_items')
            ->where('user_id', '=', Auth::user()->id)
            ->where('is_mark_as_favorite', '!=', 0)
            ->orderBy('published_at', 'desc')->paginate(15);

        $data = array(
            'podcastItems' => $podcastItems,
        );

        return view('podcasts.favorites', $data);
    }

    /**
     * Return a view to manage settings
     * @return view
     */
    public function settings() {
        return view('podcasts.settings');
    }

    /**
     * Store a newly created podcast in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // create "images" directory under "public" directory if it doesn't exist
        // if (!File::exists(public_path() . '/images')) {
        //     File::makeDirectory(public_path() . '/images');
        // }

        $user = Auth::user();

        if ($request->feed_url) {

            $feed = Feeds::make($request->feed_url);
            $feed->force_feed(true);
            $feed->handle_content_type();
            $podcastName = $feed->get_title();

            if ($podcastName && $podcastName != '') {
                // check if the feed's first item has an audio file in its enclosure
                if (strpos($feed->get_items()[0]->get_enclosure()->get_type(), 'audio') !== false) {
                    $podcastMachineName = strtolower(preg_replace('/\s+/', '', $podcastName));

                    // Save the feed thumbnail to file system and save file path to database
                    $img = Image::make($feed->get_image_url())->resize(100, 100);
                    $img->save(public_path('images/' . $podcastMachineName . '.png'));

                    Podcast::create([
                        'name' => $podcastName ? $podcastName : '',
                        'machine_name' => $podcastMachineName,
                        'feed_url' => $request->feed_url,
                        'feed_thumbnail_location' => 'images/' . $podcastMachineName . '.png',
                        'user_id' => $user->id,
                        'web_url' => $feed->get_link(),
                    ]);

                    foreach ($feed->get_items() as $item) {
                        PodcastItem::create([
                            'podcast_id' => DB::table('podcasts')
                                ->select('id', 'machine_name')
                                ->where('machine_name', '=', $podcastMachineName)->first()->id,
                            'user_id' => $user->id,
                            'url' => $item->get_permalink(),
                            'audio_url' => $item->get_enclosure()->get_link(),
                            'title' => $item->get_title(),
                            'description' => trim(strip_tags(str_limit($item->get_description(), 200))),
                            'published_at' => $item->get_date('Y-m-d H:i:s'),
                        ]);
                    }

                    // @todo Podcast was added
                    return redirect('podcasts/player');
                } else {
                    // @todo flash msg
                    return 'This doesn\'t seem to be an RSS feed with audio files. Please try another feed.';
                }
            } else {
                // @todo Could not add podcast
                return 'Sorry, this feed cannot be imported. Please try another feed';
            }

        } else {
            // @todo use validation
            return 'Invalid feed URL given.';
        }
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Delete a podcast
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Podcast::findOrFail($id)->delete();

        return back()->with('success', 'Successfully deleted the Podcast!');

    }

}
