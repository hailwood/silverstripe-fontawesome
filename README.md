Silverstripe Font Awesome Icon Picker
====================================

#### A Silverstripe Font Awesome Icon Picker:
![Screenshot](/snapshot.gif?raw=true)

* **Always up to date**: We read the yaml from the font awesome repository. Just specify your version and you're read to go.
* **Optional on the frontend**: We know on the frontend you might like to bundle your own font awesome icons, so you choose if you want us to load them from the CDN.

#### Options

```yml
FontAwesomeIconField:
  version: 4.6.3
  autoload_css: true
````

#### Usage
##### Dataobject/Page
```php
class PageWithIcon extends Page {

    protected static $db = [
        'PageIcon' => 'FontAwesomeIcon',
    ];
    
    public function getCMSFields(){
        $fields = parent::getCMSFields();
        
        $fields->addFieldToTab('Root.Main', FontAwesomeIconField::create('PageIcon', 'Icon'));
        
        return $fields;
    }

} 

````
##### SS Template (if you have other classes to add)
```html
<div>
<strong>Page Icon:</strong> <i class="{$PageIcon.Classes} some-other-class"></i>
</div>
````

##### SS Template (if you don't want to customize it)
```html
<div>
<strong>Page Icon:</strong> {$PageIcon}
</div>
````
