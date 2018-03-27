## Sample project 
Symfony 3.4 with Docker php 7.2, nginx and mysql.

```
php -v
PHP 7.2.3 (cli) (built: Mar 22 2018 22:37:54) ( NTS )
Copyright (c) 1997-2018 The PHP Group
Zend Engine v3.2.0, Copyright (c) 1998-2018 Zend Technologies
    with Zend OPcache v7.2.3, Copyright (c) 1999-2018, by Zend Technologies
```

## For development
* Checkout project.
* Enter folder symfony
* Execute `composer install --ignore-platform-reqs` ( No need to check if you have all required php installed )
* Return to main project folder and run: `docker-compose up -d --build`
* Go to "localhost" on your browser.

If you wanna stop docker, run: `docker-compose down`, later you can start it with just `docker-compose up -d`

If you have locally mysql installed you can disable docker mysql for starting in docker-compose yml
 file and just set the configuration so symfony can use that DB.
  
If you have another web server running localhost Docker will map the output port to nginx that's free.
Check that running `ocker ps`, you should see something like:

```bash
0.0.0.0:80->80/tcp       jc-nginx
``` 
0.0.0.0:80  is your host address and port. 

If you wanna login to the php container to use phpunit or php commands:
```bash
docker exec -ti jc-php sh
```
To exit, `exit`