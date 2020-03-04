<?php namespace IITU\Core\Classes;

use Request;

use IITU\Core\Models\Locale;

class Translator {
    use \October\Rain\Support\Traits\Singleton;

    /**
     * @var string The locale to use on the front end.
     */
    protected $activeLocale;

    /**
     * @var string The default locale if no active is set.
     */
    protected $defaultLocale;

    /**
     * Initialize the singleton
     * @return void
     */
    public function init() {
        $this->defaultLocale = 'ru';
        $this->activeLocale = $this->defaultLocale;
    }



    /**
     * Changes the locale in the application and optionally stores it in the session.
     * @param   string  $locale   Locale to use
     * @param   boolean $remember Set to false to not store in the session.
     * @return  boolean Returns true if the locale exists and is set.
     */
    public function setLocale($locale) {
        if (!Locale::isValid($locale)) {
            return false;
        }

        $this->activeLocale = $locale;
        return true;
    }

    /**
     * Returns the active locale set by this instance.
     * @param  boolean $fromSession Look in the session.
     * @return string
     */
    public function getLocale() {
        return $this->activeLocale;
    }



    /**
     * Returns the default locale as set by the application.
     * @return string
     */
    public function getDefaultLocale() {
        return $this->defaultLocale;
    }


    /**
     * Sets the locale based on the first URI segment.
     * @return bool
     */
    public function loadLocaleFromRequest() {
        $locale_code = Request::segment(1);
        if (!Locale::isValid($locale_code)) {
            return false;
        }

        $this->setLocale($locale_code);
        return true;
    }
}