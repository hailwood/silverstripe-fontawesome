<?php

class FontAwesomeIconField extends GroupedDropdownField
{
    public function __construct($name, $title = null)
    {
        parent::__construct($name, $title);
        $this->addExtraClass('font-awesome-picker select2 no-chzn');
        $this->setEmptyString('Select an icon...');
    }


    protected static $extensions = [
        'FontAwesomeIconFieldConfigProvider'
    ];

    public function getSource()
    {

        $icons =  Config::inst()->get(get_called_class(), 'icons')['categorized'];

        return $icons;
    }

    public function getAttributes()
    {
        $attributes = parent::getAttributes();
        if($this->getHasEmptyDefault()){
            $attributes['data-placeholder'] = $this->getEmptyString();
        }

        if(!$this->Required()){
            $attributes['data-allow-clear'] = 'true';
        }


        return $attributes;
    }

    public function Field($properties = array())
    {

        $version = $this->config()->get('version');
        Requirements::css("//maxcdn.bootstrapcdn.com/font-awesome/{$version}/css/font-awesome.min.css");
        Requirements::css('//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css');
        Requirements::javascript('//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js');
        Requirements::javascript(ICONPICKER_DIR . "/javascript/iconpicker.js");

        //additional styling to fit the moderno admin theme
        if (class_exists('ModernoAdminExtension')) {
            Requirements::css(ICONPICKER_DIR . "/css/iconpicker-moderno.css");
        } else {
            Requirements::css(ICONPICKER_DIR . "/css/iconpicker-standard.css");
        }

        $options = '';

        if ($this->getHasEmptyDefault()) {
            $options .= '<option></option>';
        }

        foreach ($this->getSource() as $value => $title) {
            if (is_array($title)) {
                $options .= "<optgroup label=\"$value\">";
                foreach ($title as $value2 => $title2) {
                    $disabled = '';
                    if (array_key_exists($value, $this->disabledItems)
                        && is_array($this->disabledItems[$value])
                        && in_array($value2, $this->disabledItems[$value])
                    ) {
                        $disabled = 'disabled="disabled"';
                    }
                    $selected = $value2 == $this->value ? " selected=\"selected\"" : "";
                    $options .= "<option$selected value=\"$value2\" data-unicode=\"{$title2['unicode']}\" $disabled>{$title2['label']}</option>";
                }
                $options .= "</optgroup>";
            } else { // Fall back to the standard dropdown field
                $disabled = '';
                if (in_array($value, $this->disabledItems)) {
                    $disabled = 'disabled="disabled"';
                }
                $selected = $value == $this->value ? " selected=\"selected\"" : "";
                $options .= "<option$selected value=\"$value\" $disabled>$title</option>";
            }
        }

        return FormField::create_tag('select', $this->getAttributes(), $options);
    }

}