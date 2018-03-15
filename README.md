# API testing with Codeception example

To install and run example tests do next things:

```bash
# install packages with composer
docker run --rm -v `pwd`/app:/app composer/composer install
 
# create and start containers
docker-compose up -d
 
# run tests with codeception
docker-compose exec app vendor/bin/codecept run
 
# run functional tests only
docker-compose exec app vendor/bin/codecept run functional
 
# run exact functional test
docker-compose exec app vendor/bin/codecept run functional BasicCest
 
# run functional tests in debug mode
docker-compose exec app vendor/bin/codecept run functional --debug
```
