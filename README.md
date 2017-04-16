# codecombat-api
### PHP SDK for CodeCombat REST API

**codecombat-api** is a SDK for the [CodeCombat](https://codecombat.com/api-docs) REST API.
It provides an abstracted interface to talk with the CodeCombat API. The Package contains a Laravel ServiceProvider to inject it into the Laravel Service Container, but other than that the package is framework-independant. Please look at the [CodeCombat API Documentation](https://codecombat.com/api-docs) for more details and do not be afraid to peruse the source code on this package.

## Installation

`composer require timutech/codecombat-api`

## Configuration

You will preferably need to have your own OAuth2 server. You will need to have a lookup URL where CodeCombat can query an AccessToken you give them and then you will return the User on your system linked to that AccessToken.
eg
`https://yoursite.com/api/auth/{token}` which returns a User with a **required** `id` field.

### Normal

Make sure you keep your CodeCombat OAuth `{CLIENT_ID}`, `{CLIENT_SECRET}` and `{OAUTH_PROVIDER_ID}` in whatever config you have as you will need it to instantiate an instance.

### Laravel

Add the line `TimuTech\CodeCombat\CodeCombatserviceProvider::class,` like below in your `config/app.php` file.

```php
'providers' => [
	// Other

	TimuTech\CodeCombat\CodeCombatserviceProvider::class,
],
```

Add your CodeCombat OAuth credentials to your `config/services.php` file, as below.

```php
// Other services

'codecombat' => [
    'id' => '{CLIENT_ID}',
    'secret' => '{CLIENT_SECRET}',
    'provider_id' => '{OAUTH_PROVIDER_ID}'
]
```

## Usage

Refer to the source code for other functionality or create a pull request for addition of functionality. I will endeavour to keep adding features whenever I can.

### Normal

Instantiate
```php
$codecombat = new CodeCombat(
	{CLIENT_ID},
	{CLIENT_SECRET},
	{OAUTH_PROVIDER_ID}
);
```
Create a new user
```php
$user = {A user from your system}
$combatUser = $codecombat->register([
    'name' => $user->name, // UNIQUE Nick Name
    'email' => $user->email, // NEW Email,
    'role' => 'student' //or 'teacher'
]);
```
Assign an OAuth Identity
```php
$token = {YOUR OAuth2 token, generated for your user from your server}
$codecombat->setAuth($token)->createIdentity($combatUser);
```
Retrieve the user later
```php
$token = {YOUR OAuth2 token, generated for your user from your server}
$handle = {UNIQUE Nick Name assigned earlier or the CodeCombat ID of the user, if you have it}
$combatUser = $codecombat->setAuth($token)->getUser($handle);
```
Get the url to redirect to CodeCombat
```php
$token = {YOUR OAuth2 token, generated for your user from your server}
$url = $codecombat->setAuth($token)->redirect();
```

The `TimuTech\CodeCombat\Resources\CombatUser` class has some helpful methods and attributes, to name a few:
```php
$combatUser->getEmail();
$combatUser->getId();
$combatUser->getProfile();
```
Once again, the source code is your friend.