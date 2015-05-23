<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	protected $fillable = [
		'title',
		'body',
		'published_at',
		'user_id' // temporary
	];

	protected $dates = ['published_at']; // treat it as a Carbon instance

	public function scopePublished($query)
	{
		$query->where('published_at', '<=', Carbon::now());
	}

	public function scopeUnpublished($query)
	{
		$query->where('published_at', '>', Carbon::now());
	}

	public function setPublishedAtAttribute($date)
	{
		// $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
		$this->attributes['published_at'] = Carbon::parse($date); // 2015-01-28 00:00:00
	}

	/**
	 * An article is owned by a user.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
	    return $this->belongsTo('App\User');
	}


	public function tags()
	{
		return $this->belongsToMany('App\Tag')->withTimestamps();
	}

	/**
	 * Get a list of tag ids associated with the current article
	 * @return array
	 */
	public function getTagListAttribute()
	{
	    return $this->tags->lists('id');
	}
}
