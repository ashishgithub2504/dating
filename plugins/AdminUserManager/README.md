# AdminUserManager plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/AdminUserManager
```

AdminUserManager
----------------------------------------------------------------------------------------------------
bin\cake bake plugin AdminUserManager

	----------------------------- Create Migraqtion Files -----------------------------
	bin\cake bake migration -p AdminUserManager createRoles title:string[100] created modified

	bin\cake bake migration -p AdminUserManager createAdminUsers name:string[150] mobile:string[15] dob:date email:string[180]:unique:EMAIL_INDEX password:string[255] profile_photo:string status:boolean is_verified:boolean login_count:integer created modified

	bin\cake bake migration -p AdminUserManager createAdminUsersRoles role_id:integer[5]:INDEX admin_user_id:integer[11]:INDEX
	
	------------- used for fake password -------------
	bin\cake bake migration -p AdminUserManager AddFakePassToAdminUsers fake_pass:string[250]
	
	bin\cake bake migration -p AdminUserManager createUserTokens user_id:integer:default:NULL user_type:enum[admin_user,website_users] token_type:enum[forgot_password,email_verfication] token:string status:boolean created modified

	bin\cake bake migration -p AdminUserManager AddIsDefaultToRoles is_default:boolean
	
	-----------------------------//Create Migraqtion Files -----------------------------
	
	bin\cake migrations migrate -p AdminUserManager

	

	bin\cake bake all --plugin AdminUserManager roles --prefix admin -t BackEnd (this command use when you create new plugin)
	bin\cake bake all --plugin AdminUserManager admin_users --prefix admin -t BackEnd (this command use when you create new plugin)


	bin\cake bake seed Roles --plugin AdminUserManager		(this command use when you create new plugin)

	bin\cake migrations seed --seed RolesSeed --plugin AdminUserManager

	bin\cake bake seed AdminUsers --plugin AdminUserManager	(this command use when you create new plugin)


	bin\cake migrations seed --seed AdminUsersSeed --plugin AdminUserManager

	bin\cake bake seed AdminUsersRoles --plugin AdminUserManager	(this command use when you create new plugin)

	bin\cake migrations seed --seed AdminUsersRolesSeed --plugin AdminUserManager

	bin\cake migrations rollback -p AdminUserManager