# SettingManager plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/SettingManager
```

SettingManager
----------------------------------------------------------------------------------------------------
bin\cake bake plugin SettingManager


	bin\cake bake migration -p SettingManager createSettings title:string[150] slug:string:unique config_value:text manager:string:default:NULL field_type:enum[checkbox,text] created modified

	bin\cake migrations migrate -p SettingManager

	bin\cake bake all --plugin SettingManager settings --prefix admin -t BackEnd 	(this command use when you create new plugin)

	bin\cake bake seed Settings --plugin SettingManager		(this command use when you create new plugin)
	bin\cake migrations seed --seed SettingsSeed --plugin SettingManager
