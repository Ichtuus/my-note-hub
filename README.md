https://travis-ci.com/Ichtuus/my-note-hub.svg?branch=master

# Symfony Docker

A [Docker](https://www.docker.com/)-based installer and runtime for the [Symfony](https://symfony.com) web framework, with full [HTTP/2](https://symfony.com/doc/current/weblink.html) and HTTPS support.


## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose up` (the logs will be displayed in the current shell). 
<br> Or <br> 
Run `SYMFONY_VERSION=4.4.* docker-compose up --build` to choose an specific symfony version
<br> And <br>
Run `SERVER_NAME=symfony.wip docker-compose up --build` to choose an custom server name
3. If you work on linux and cannot edit the poject after the first installation Run `docker-compose run --rm php chown -R $(id -u):$(id -g) .` for add files right 
4. Run `npm install`
5. Open `https://yourservername.localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)

## Docker Features

* Production, development and CI ready
* Automatic HTTPS (in dev and in prod!)
* HTTP/2, HTTP/3 and [Server Push](https://symfony.com/doc/current/web_link.html) support
* [Vulcain](https://vulcain.rocks)-enabled
* Just 2 services (PHP FPM and Caddy server)
* Super-readable configuration
