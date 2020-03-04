<?php namespace IITU\Core\Models;

use Model;
use Cache;

/**
 * Locale Model
 */
class Locale extends Model {
    /**
     * @var string The database table used by the model.
     */
    public $table = 'iitu_locales';

    /**
     * The primary key for the model is not an integer.
     *
     * @var bool
     */
    public $incrementing = false;

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


    /**
     * @var array A cache of enabled locales.
     */
    protected static $cacheList;



    /**
     * Lists the enabled locales, used on the front-end.
     * @return array
     */
    public static function list() {
        if (self::$cacheList) {
            return self::$cacheList;
        }

        $list = Cache::remember('iitu.core.locales', 1440, function() {
            return self::all()->lists('id');
        });

        return self::$cacheList = $list;
    }

    /**
     * Returns true if the supplied locale is valid.
     * @return boolean
     */
    public static function isValid($locale_code) {
        $languages = Locale::list();

        return in_array($locale_code, $languages);
    }
}
