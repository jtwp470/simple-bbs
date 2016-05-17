# Simple BBS
[![License](http://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](./LICENSE)

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

This is a very simple BBS site used by PHP.

## IMPORTANT NOTICE
**This site has many security problems.** (e.g. XSS, SQL injection, CSRF, session hijack, and so on.)
Please **DO NOT USE** this site on the production.

## Usage
### Development (On your local machine)
We required docker and docker-compose.

``` bash
$ docker-compose up
$ open http://localhost:8080/
```

### Production (On Heroku)
We use the basic authentication. Please set the environment variables like this:

```bash
$ heroku config:set BASIC_AUTH_USERNAME="simplebbs"
$ heroku config:set BASIC_AUTH_PASSWORD="password"
```

Next, we need to setup database tables. Please do on your hand. Sorry.

## LICENSE
Licensed under the MIT license.

See [LICENSE](./LICENSE)
