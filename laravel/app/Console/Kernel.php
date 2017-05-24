<?php

namespace App\Console;

use App\Models\Election;
use \App\Models\Candidate_election;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ArteveldeDbBackup::class,
        Commands\ArteveldeDbDrop::class,
        Commands\ArteveldeDbInit::class,
        Commands\ArteveldeDbReset::class,
        Commands\ArteveldeDbRestore::class,
        Commands\ArteveldeDbUser::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            $elections = Election::with('candidates')->get();
            $i = 0;
            foreach ($elections as $election){
                //save current datetime in var
                $now =  Carbon::now();

                //save start and end datetime in var
                $start = $election->startDate;
                $end = $election->endDate;

                //put candidates in it's own var
                $candidates = $election->candidates;

                //Replace old election

                //if start date is in the future
                if($now <= $start && $election->isClosed === false){
                    //close the election
                    $newElection = Election::find($election->id);
                    $newElection->isClosed = true;
                    $newElection->save();
                }

                //if start date is in the past and end date in the future
                elseif($now>=$start&&$now<=$end && $election->isClosed === true ){
                    //open the election
                    $newElection = Election::find($election->id);
                    $newElection->isClosed = false;
                    $newElection->save();
                }

                //else (if end date is in the past)
                else{
                    //close the election
                    $newElection = Election::find($election->id);
                    $newElection->isClosed = true;
                    $newElection->save();

                    //calculate score for each candidate
                    foreach ($candidates as $candidate){

                        //score is the count of all the votes a certain candidate has for a certain election
                        $score = Vote::where('CandidateElection_id','=',$candidate->pivot->id)->count();

                        //replace the old score
                        $canEl = Candidate_election::find($candidate->pivot->id);
                        $canEl->score = $score;
                        $canEl->save();
                    }
                }

            }
        })->everyThirtyMinutes();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
