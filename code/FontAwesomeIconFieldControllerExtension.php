<?php


class FontAwesomeIconFieldControllerExtension extends DataExtension
{


    public function contentcontrollerInit()
    {

        if (Config::inst()->get('FontAwesomeIconField', 'autoload_css')) {
            $version = Config::inst()->get('FontAwesomeIconField', 'version');
            Requirements::css("//maxcdn.bootstrapcdn.com/font-awesome/{$version}/css/font-awesome.min.css");
        }
    }
}