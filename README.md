# CakePHP Application Skeleton

[![Build Status](https://img.shields.io/travis/cakephp/app/master.svg?style=flat-square)](https://travis-ci.org/cakephp/app)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 3.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

UserManager
----------------------------------------------------------------------------------------------------
bin\cake bake plugin UserManager

	----------------------------- Create Migraqtion Files -----------------------------
	
	bin\cake bake migration -p UserManager createUsers first_name:string[100] last_name:string[50] mobile:string[15] dob:date email:string[180]:unique:EMAIL_INDEX password:string[255] profile_photo:string status:boolean is_verified:boolean login_count:integer created modified

	bin\cake bake migration -p UserManager createAccountTypes title:string[100] created modified

	bin\cake bake migration -p UserManager createUsersAccountTypes user_id:integer[5]:INDEX account_type_id:integer[11]:INDEX

	bin\cake bake migration -p UserManager AddFakePassToUsers fake_pass:string[250]
	
	----------------------------- //Create Migraqtion Files -----------------------------
	
	
	bin\cake migrations migrate -p UserManager

	bin\cake bake all --plugin UserManager account_types --prefix admin -t BackEnd		(this command use when you create new plugin)
	bin\cake bake all --plugin UserManager users --prefix admin -t BackEnd				(this command use when you create new plugin)

	bin\cake bake seed AccountTypes --plugin UserManager	(this command use when you create new plugin)
	bin\cake bake seed Users --plugin UserManager		(this command use when you create new plugin)
	bin\cake bake seed UsersAccountTypes --plugin UserManager 	(this command use when you create new plugin)

	bin\cake migrations seed --seed AccountTypesSeed --plugin UserManager
	bin\cake migrations seed --seed UsersSeed --plugin UserManager
	bin\cake migrations seed --seed UsersAccountTypesSeed --plugin UserManager
	bin\cake migrations seed --seed UserImagesSeed --plugin UserManager

	bin\cake migrations rollback -p UserManager