<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Hash;
use CreateVotesTable;
use Ramsey\Uuid\Uuid;


class Vote extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'voteType', 'agreed', 'referendum_id', 'CandidateElection_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relates a Vote with a Referendum
     */
    public function referendum()
    {
        return $this->belongsTo(Referendum::class);
    }

    /**
     * @var bool
     * to prevent connection with user
     */
    public $timestamps = false;

    /**
     * @var array
     * allow everything
     */
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        /**
         * Register a creating model event with the dispatcher.
         */
        static::creating(function(Vote $vote) {
            // Create Universally Unique Identifier.
            do {
                //uuid4 creates a random uuid.
                $uuid = Uuid::uuid4()->toString(); // @see https://github.com/ramsey/uuid
            } while (DB::table(CreateVotesTable::TABLE)
                ->select(CreateVotesTable::PK)
                ->where(CreateVotesTable::PK, $uuid)
                ->exists());
            $vote->uuid = $uuid;

            // Create Checksum, assume password
            $data = $vote->getAttributes();
            ksort($data);
            $value = hash('sha512', (json_encode($data)).$vote->checksum);
            // \Log::debug([$data, $value]);
            $vote->checksum = bcrypt($value);
        });
    }
}