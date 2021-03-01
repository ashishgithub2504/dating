# CmsManager plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/CmsManager
```
CmsManager
----------------------------------------------------------------------------------------------------
bin\cake bake plugin CmsManager

	bin\cake bake migration -p CmsManager createPages title:string[150] sub_title:string[150] slug:string[250]:unique short_description:string[400] description:text banner:string[200] meta_title:string meta_keyword:string[300] meta_description:text status:boolean created modified

	bin\cake bake migration -p CmsManager createNavigations title:string[150] slug:string[250]:unique parent_id:integer:PARENTID_INDEX menu_link:string[255] is_nav_type:integer[2] lft:integer rght:integer status:boolean created modified

	bin\cake bake migration -p CmsManager createModules title:string[150] manager:string[120]:default:NULL controller:string[120] action:string[100] json_path:string[400] banner:string[200] meta_title:string meta_keyword:string[300] meta_description:text status:boolean created modified

	bin\cake bake migration -p CmsManager AddPositionsToNavigations is_top:boolean is_bottom:boolean 
	
	-------------------------------------------------------------------
	
	bin\cake migrations migrate -p CmsManager

	bin\cake bake all --plugin CmsManager pages --prefix admin -t BackEnd  (this command use when you create new plugin)
	bin\cake bake all --plugin CmsManager modules --prefix admin -t BackEnd (this command use when you create new plugin)
	bin\cake bake all --plugin CmsManager navigations --prefix admin -t BackEnd (this command use when you create new plugin)

	bin\cake bake seed Pages --plugin CmsManager (this command use when you create new plugin)
	bin\cake bake seed Modules --plugin CmsManager (this command use when you create new plugin)
	bin\cake bake seed Navigations --plugin CmsManager (this command use when you create new plugin)
	
	bin\cake migrations seed --seed PagesSeed --plugin CmsManager