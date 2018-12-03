### CinemaManager | [1/3] API


## SETUP

1) Get new env file from env example
2) Set up db
3) Set up JWT
JWT_SECRET;
JWT_PASSPHRASE;
JWT_ALGO;
4) Add private and public key in the storage/jwt
5) Set up mail in env

## Running

1) make migrations with seed data
```
php aritsan migrate --seed
```
2) Run project on localhost or in LAN
```
php artisan serve / OR / php artisan serve --host=COMPUTER_LAN_IP --port=8000
```
## DB Project

![alt text](https://i.gyazo.com/bc2eeed8e17a340d79444e7e401d240c.png)

## Routes
![alt text](https://i.gyazo.com/785352b2a754754a2c12afcf69ddeca1.png)

## About CinemaManager Project

It is schoolarship project.

"Owner of fiction cinema called "XD CINEMA" needs seats reservation system.
Project contains:

    1) API - backend,

    2) Admin web panel for cinema staff, where employees can create and update showings,

    3) Mobile andorid app where clients can make reservations"

### CinemaApp includes 3 elements:
1) REST API - [GITHUB](https://github.com/krzychna33/CinemaManager_API)

2) Front-end web app for cinema staff - [GITHUB](https://github.com/krzychna33/CinemaManager_staffWebApp)

3) Android App for Cinema clients - [GITHUB](https://github.com/krzychna33/CinemaManager_AndroidClientApp)

