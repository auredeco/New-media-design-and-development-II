<?php

namespace App;

use App\Models\{
    History, Post, Voter, Candidate, Group
};
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'firstname', 'lastname', 'gender', 'birthdate', 'email', 'password', 'lastLogin', 'pictureUri', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'lastLogin',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @param $birthDate
     * @return int
     *
     * Function that returns the age when given the birthDate
     */
    public static function getAge($birthDate)
    {
//        cut dates in year, month, day
        $birthDate = explode("-", $birthDate);
        $currentDate = explode("-", date('Y-m-d'));
        $age = 0;

//        if birthdate month is smalle than current month
        if ($birthDate[1] < $currentDate[1]) {

//            subtract birth year from current year
            $age = $currentDate[0] - $birthDate[0];
        } //        if birth month is equal to current month
        elseif ($birthDate[1] == $currentDate[1]) {
//            if birth day is smaller than  current day
            if ($birthDate[2] <= $currentDate[2]) {
//                subtract birth year from current year
                $age = $currentDate[0] - $birthDate[0];
            } //            else subtract birth year from current year and subtract 1
            else $age = $currentDate[0] - $birthDate[0] - 1;
        } //        if birth month is higher than current month
        else {
//            if birth day is smaller or equal to current day
            if ($birthDate[2] <= $currentDate[2]) {
//                subtract birth year from current year
                $age = $currentDate[0] - $birthDate[0];
            } //            else subtract birth year from current year and subtract 1
            else $age = $currentDate[0] - $birthDate[0] - 1;
        }
        return $age;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     *
     * Function that returns the amount of users created per month
     */
    public static function getRegisteredMonth()
    {
        return User::select(\DB::raw('count(id) as `total`'),
            \DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupby('year', 'month')
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relates a user with a voter
     */
    public function voter()
    {
        return $this->belongsTo(Voter::class, 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relates a user with a candidate
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * Relates a user with posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * relates a user with history
     */
    public function history()
    {
        return $this->hasMany(History::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * Relates a User with Groups
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_users');
    }

    /**
     * @param $query
     * @param $keyword
     * @return mixed
     *
     * Filter function that returns query from database by given keyword
     */
    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where("firstname", "LIKE", "%$keyword%")
                    ->orWhere("lastname", "LIKE", "%$keyword%")
                    ->orWhere("email", "LIKE", "%$keyword%")
                    ->orWhere("gender", "=", "$keyword")
                    ->orWhere("username", "LIKE", "%$keyword%")
                    ->orWhere("birthdate", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }
}
