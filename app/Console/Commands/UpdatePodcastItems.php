<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use App\PodcastItem;
use App\Podcast;
use Feeds;

class UpdatePodcastItems extends Command {
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'updatePodcastItems';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update podcast items daily at 5 AM - from RSS feeds';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Update podcast items
     *
     * @return mixed
     */
    public function handle() {

        $uniquePodcasts = DB::table('podcasts')
            ->select('id', 'feed_url', 'machine_name')
            ->groupBy('id')->get();

        foreach ($uniquePodcasts as $podcast) {
            $usersSubscribedToThisPodcast = DB::table('podcasts')
                ->select('user_id', 'id as podcast_id')
                ->where('machine_name', '=', $podcast->machine_name)
                ->get();

            $items = Feeds::make($podcast->feed_url)->get_items();

            // Calculate 48 hours ago
            $yesterday = time() - (24 * 2 * 60 * 60);

            foreach ($items as $item) {
                $itemPubDate = $item->get_date();

                if ($item->get_date('U') > $yesterday) {

                    // new items
                    foreach ($usersSubscribedToThisPodcast as $subscriber) {

                        $podcastItemsCount = DB::table('podcast_items')
                            ->select('user_id', 'title', 'podcast_id')
                            ->where('title', '=', strip_tags($item->get_title()))
                            ->where('user_id', '=', $subscriber->user_id)
                            ->where('podcast_id', '=', $subscriber->podcast_id)
                            ->count();

                        // if this item is not already in the DB
                        if ($podcastItemsCount == 0) {
                            PodcastItem::create([
                                'user_id' => $subscriber->user_id,
                                'title' => strip_tags($item->get_title()),
                                'description' => strip_tags(str_limit($item->get_description(), 100)),
                                'published_at' => $item->get_date('Y-m-d'),
                                'url' => $item->get_permalink(),
                                'audio_url' => $item->get_enclosure()->get_link(),
                                'podcast_id' => $subscriber->podcast_id,
                            ]);
                        }
                    }
                } else {
                    break;
                }
            }

        }

    }
}