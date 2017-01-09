<?php

class FontAwesomeIcon extends DBField
{

    protected static $icon_list = [

    ];

    /**
     * @var array
     */
    private static $casting = [
        "Name"    => "Text",
        "Classes" => "Text",
        'Icon'    => 'HTMLText',
    ];

    /**
     * (non-PHPdoc)
     * @see DBField::requireField()
     */
    public function requireField()
    {
        DB::require_field($this->tableName, $this->name, [
            'type'  => 'varchar',
            'parts' => [
                'datatype'      => 'varchar',
                'precision'     => 25,
                'character set' => Config::inst()->get('MySQLDatabase', 'charset'),
                'collate'       => Config::inst()->get('MySQLDatabase', 'collation'),
                'arrayValue'    => $this->arrayValue
            ]
        ]);
    }

    /**
     * @param null $title
     * @return FormField
     */
    public function scaffoldFormField($title = null)
    {
        return FontAwesomeIconField::create($this->name, $title);
    }

    public function Classes(){
        return $this->exists() ? "fa fa-{$this->getValue()}" : null;
    }

    public function Icon(){
        return "<i class=\"{$this->Classes()}\"></i>";
    }

}
