<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Installation

In your blockchain:
- Create tblUser stream and subscribe it
- Create tblGeneral stream and subscribe it

Run the command:
```
	composer install
```

Change .env.example to .env

Edit .env and add your rpc credentials

Run the command:
```
	php artisan config:cache
```


## Flow
Register
- Generate the key value pair for the user
- Add the new the value pair in the tlbGeneral stream in this format:
	- key: [address]
	- value: md5([address])

- Add the registered user in the tblUser stream in this format:
	- key: [email]
	- value: [address] <---- encrypt it with AES, the secret key is the password

- Create a stream for the current registered user in this format then subscribe it:
	- stream id/name: md5([address])
		
        items:
        
			- key: name
			- value: <name>
			- key: email
			- value: <email>
    
Login
- Get the input email and check if it exist in tblUser
- Decrypt the value from the tblUser using AES(secret key is the input password) to get the address
- Once we get the address, we will use it as a key in the tblGeneral in order to get the stream id/name
- Use the stream id/name to get the stream of the user
