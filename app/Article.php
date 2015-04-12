<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	protected $fillable = [
		'title',
		'body',
		'published_at'
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
}
