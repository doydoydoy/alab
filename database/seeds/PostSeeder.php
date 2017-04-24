<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($x=0; $x < 200; $x++)
        {
            $thread_id = rand(1, 100);
            $curr_date = Carbon::now();

        	DB::table('posts')->insert(
	        [
                'content' => "Post no. ".$x." ".str_random(10),
	        	'author_id' => rand(1,3),
	        	'thread_id' => $thread_id,
                'created_at' => $curr_date,
                'updated_at' => $curr_date,
	        ]);

            DB::table('threads')->where('id', $thread_id)
                                ->update(['updated_at' => $curr_date]);
        }
    }
}
