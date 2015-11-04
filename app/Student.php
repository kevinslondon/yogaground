<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'yogablog_newsletter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function workshops()
    {
        return $this->belongsToMany('App\Workshop','mysite_class_attedance','uid','wid');
    }


    public function isStudent($name, $email)
    {
        return $this
            ->where('email', $email)
            ->where('name', $name)
            ->count();
    }


    /**
     * @param $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        return $this
            ->where('email', $email)
            ->get()
            ->first();
    }

    /**
     * @param $name
     * @param $email
     */
    public function getByEmailAndName($name, $email)
    {
        return $this
            ->where('email', $email)
            ->where('name', $name)
            ->get()
            ->first();
    }

    public function isRegistered($name, $email, $workshop_id)
    {
        $student = $this->getByEmailAndName($name,$email);
        if(!$student || !$student->id){
            return false;
        }
        if(!$student->workshops){
            return false;
        }

        foreach($student->workshops as $workshop){
            if($workshop->id == $workshop_id){
                return true;
            }
        }
        return false;
    }
}
