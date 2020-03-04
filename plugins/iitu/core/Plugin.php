<?php namespace IITU\Core;

use Lang;
use Backend;
use System\Classes\PluginBase;

use IITU\Core\Models\Translate;
use IITU\Core\Classes\Translator;

/**
 * Core Plugin Information File
 */
class Plugin extends PluginBase {
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails() {
        return [
            'name'        => 'Core',
            'description' => 'No description provided yet...',
            'author'      => 'Skyal',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register() {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot() {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents() {
        return []; // Remove this line to activate

        return [
            'IITU\Core\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions() {
        return []; // Remove this line to activate

        return [
            'iitu.core.some_permission' => [
                'tab' => 'Core',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation() {
        return []; // Remove this line to activate

        return [
            'core' => [
                'label'       => 'Core',
                'url'         => Backend::url('iitu/core/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['iitu.core.*'],
                'order'       => 500,
            ],
        ];
    }


    /**
     * Register new Twig variables
     * @return array
     */
    public function registerMarkupTags() {
        return [
            'filters' => [
                'lang'  => [$this, 'translateString']
            ]
        ];
    }


    public function translateString($key, $params = []) {
        $translator = Translator::instance();
        $locale_code = $translator->getLocale();
        $value = '';

        if (count($params) === 0) {
            $translate = Translate::getByKeyAndLocaleCode($key, $locale_code)->first();

            $value = ($translate !== null ? $translate->value : '¯\_(ツ)_/¯');
        } else if ($locale_code === $params) {
            return $key;
        }

        return $value;
    }
}
