# bileMo

In order to install the bileMo Project, you have to follow these indications : 

## Prepare your environment

- First, you need to install git, Composer and Docker

Follow the steps for Git Installation here : https://git-scm.com/downloads

For Composer here : https://getcomposer.org/download/

And for Docker (for Mac, but Windows Installation is not far away :)) here : https://docs.docker.com/docker-for-mac/

- Now your're ready to use git. It's time to init project : to do this, go to your working directory and use this command :

```
git init
```

Copy and paste the following line on your terminal (or console) :
```
git clone https://github.com/lolosambo/bileMo.git
```

## Define your Environment Variables

Simply, turn the `.env.dist` into `.env` and change each variable value as you wish.

## Install your docker environment

Your Dockerfile, docker-compose.yaml files and all the base configuration are ready to use. All you have to do is write :
```
docker-compose build
docker-compose up -d
```

## Composer to the rescue !

Install all dependencies with composer with these lines :
```
make composer-install
make autoload
```

A `Makefile` gives you a lot of shortcuts for Symfony, Composer, Doctrine, PhpUnit and BlackFire most used commands

## Configure your database and make fixtures

First create your database
```
make create-database
make schema-update
```

BileMo project give to you the ability to invoke Fixtures very simply
```
make fixtures
```


## Create youy RSA Keys for Lexik/JWTAuthenticationBundle

On each request you will send, an Authentication token is required. Lexik/JWTAuthenticationBundle helps you in this way.

You'll need to create your access with these lines :
```
 openssl genrsa -out config/jwt/private.pem -aes256 4096
 openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

**Important !!** Take care to change your passphrase in your .env file by the one you choosed during the rsa keys creation step

## You are ready to send your first request !

First you'll need to authenticate as a client. To test this, go to `/api/login_check` and in a POST request fill your body with

```
{
	"username": "Client1",
	"password": "MySuperPassword"
}
```

You shall receive a token

```
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1Mzg0MTMwMjgsImV4cCI6MTUzODQxNjYyOCwicm9sZXMiOltdLCJ1c2VybmFtZSI6IkNsaWVudDEifQ.bIv3HFpM0xDibbF6qb3BZKE1MgmRsFtkX8AhnMMPbTXgBskJtDWFBKUD2TadUwE52IwtSktcVjdO8RF-VvO5lnb2q5hPZ0RIFxUUapQ-7oHgjpbDrv7Kqh22-7rHspvY-1XuzkDfN0zAdEHsDK198tb3KP_lmKvTYpJzFLKxf69iey-HpapZr88lon-D0bEs-GpmgrtfA_WrNhu_Zm-sK_tmxQ_FOwTpfRTsuroAvL7X-aUekMGBuJLEpK_iMTRBhD1y_eR-b9HctSYNdAI-lS4Gm5sw4TgQk1DBW79zuFP83hK799J-BDhlpQJHn-NMdRORMA_US50x0_sy6RG1zI8K4kkanuJ9RhccN_b_OmOcWLUvZA-yeMvlIO6z9yHjW7YYdfi9aKPLg_4nOQ-4_d2-9QTzHGh0URGbF6guRn3RbqCp3J-UbKH539QJ7nI6uMvEqE4RMgo3NQsD-WXEYG5SAViDQLJW7HCVkoOCrtibqsnWnAYf-DeqTw_WaSISta7G3YM3dQkvH1gVTHyPgxiChBsbfyZojUl-tpQ1sm2Q0jkDcAJ4BP82rft3xigHWtKDUtUgLknCGU8hzDYYP9D_-NV43hfTLWbLiqIpIBFnZIsROylEXiSXB5sqXPOtfOn9cSjQGNgwF-nAyh2EhmkJk8z6AFFSaCpjNm8QM4w"
}
```

Requests on BileMo API are simple : uri you must call depends on the resource you want to see.

You can use Postman or Insomnia (on Mac) to make request.

Before sending your request, you'll have to say to Postman that you use a Authentication token (that you received after authentication). In the `Authorization` tab, select `Bearer Token` and past the token in the `token` field. 

If you want Clients, just write `/clients`. For Users : `/users` and for Products : `/products`.

With these 3 routes you'll be able to GET, POST and DELETE some resource.

Note that you can only make POST and DELETE request on Users.


## POST requests

For users resource only, you'll need to construct the body of your request :
```
{
	"username": "value",
	"password": "value",
	"firstName": "value",
	"lastName": "value",
	"mail": "value",
	"address": {
		"number": "value(int)",
		"way": "value",
		"zipCode": "value(int)",
		"city": "value",
		"region": "value",
		"country": "value"
	},
	"phone": "value of type (xx.xx.xx.xx.xx)"
}
```

## DELETE requests

There is 2 ways to Delete a User : 
1. You can simply click on the autoDiscoverable link in the users list by using a GET request on `/Users`

2. If you know the Id's User you can make a DELETE request with this uri `/users/id`

**Important !!** You can see only Users that are affilied to a authenticated Client. With the test Data fixtures you have loaded, you'll see only Client1 'Users
