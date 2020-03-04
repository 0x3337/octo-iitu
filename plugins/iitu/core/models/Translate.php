<?php namespace IITU\Core\Models;

use Model;

/**
 * Translate Model
 */
class Translate extends Model {
    /**
     * @var string The database table used by the model.
     */
    public $table = 'iitu_translates';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];



    public function scopeGetByKeyAndLocaleCode($query, $key, $locale_code) {
        return $query->where('key', $key)->where('locale_code', $locale_code);
    }
}
