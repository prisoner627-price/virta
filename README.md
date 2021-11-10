# Virta
> Where you can charge your car
---

## Installation
Virta makes use of Docker.

0. make sure you have `git`, `docker` and `docker-compose` installed.
   ```shell
   git clone git@github.com:prisoner627-price/virta.git
   ```
1. now its time to isntall project you can also configure environments variables in .env files :
    ```shell
   make up
   make install
   make db
   ```
2. once the containers are running, your app is ready to go.
3. for acquaintance with system API's you can visit `http://localhost:8001` and see the swagger documentation for this project

### Tests
To make sure everything is working, you may run Virta's tests.
To run the tests :
   ```shell
   make shell
   php artisan test
   ```

## TODOs
There are many enhancements still applicable on Virta, most important ones include:
- **Write more and more tests.**
- Use PostGIS
- Improve swagger documentation and add all kind of exceptions and invalid messages
