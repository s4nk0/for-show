<?php

namespace App\Models;

use App\Http\Traits\HasRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRole;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'last_name',
        'description',
        'city_id',
        'phone',
        'email',
        'password',
        'isActive',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'full_name'
    ];

    public function getEmailAttribute($value)
    {
        if (!strripos($value, '@')){
            return null;
        }

        return $value;
    }

    public function getFullNameAttribute(){
        if ($this->last_name){
            return $this->last_name." ".$this->name;
        }
        return $this->name;
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function audio_content(){
        return $this->belongsToMany(AudioContent::class,'user_audio_content','user_id','content_id');
    }

    public function like_audio_content(){
        return $this->belongsToMany(AudioContent::class,'like_audio_content','user_id','content_id');
    }

    public function getAllInfoAboutLikeAudio($category){
        return $this->like_audio_content()->with('subcategory')->get()->where('subcategory.category_id',$category);
    }

    public function hasRoles($roles){
        return count(array_intersect($roles,$this->roles->pluck('title')->toArray()));
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function subcategories(){
        return $this->belongsToMany(Subcategory::class,'detection_user_subcategories','user_id','subcategory_id');
    }

    public function notes(){
        return $this->hasMany(UserNote::class);
    }

    public function course_contents(){
        return $this->belongsToMany(CourseContent::class,'user_course_contents','user_id','course_content_id');
    }

    public function invited_users(){
        return $this->belongsToMany(User::class,'user_invite','user_id','invited_user_id');
    }

    public function taked_users(){

        if ($id = DB::table('user_invite')->where('invited_user_id',$this->id)->first()){
            $id = DB::table('user_invite')->where('invited_user_id',$this->id)->first()->user_id;
        }else{
            return null;
        }

        return User::where('id',$id);
    }

    //пройденны афермации и медитации по ид
    public function getSubCategoryCountByCategory($category_id){
        return $this->audio_content()->with('subcategory')->get()->where('subcategory.category_id',$category_id)->groupBy('id')->count();
    }

    //пройденные курсы
    public function completed_courses(){
        return $this->course_contents()->get()->groupBy('id')->count();
    }

    public function user_activities(){
        return array(
            'meditation'=>$this->getSubCategoryCountByCategory(1),
            'affirmations'=>$this->getSubCategoryCountByCategory(2),
            'courses'=>$this->completed_courses(),
            'invited_users'=>$this->invited_users()->get()->count(),
        );
    }

    public function toSearchableArray()
    {
        return [
            'name'=>$this->name,
            'last_name'=>$this->last_name,
            'code'=>$this->code,
            'phone'=>$this->phone,
        ];
    }

}
