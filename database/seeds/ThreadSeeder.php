<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // date_default_timezone_set("Asia/Manila");

        for($x=0; $x < 100; $x++)
        {
            $author = rand(1, 3);
            $curr_date = Carbon::now();

        	DB::table('threads')->insert(
	        [
	        	'content' => "Thread no. ".$x." ".str_random(10),
	        	'author_id' => $author,
	        	'section_id' => rand(1, 7),
                'created_at' => $curr_date,
                'updated_at' => $curr_date,
	        ]);

            DB::table('posts')->insert(
            [
                'content' => "Post no. ".$x." ".str_random(10),
                'author_id' => $author,
                'thread_id' => ($x+1),
                'created_at' => $curr_date,
                'updated_at' => $curr_date,
            ]);
        }
    }
}
