Weather Information Service
===========================

Weather information application aimed at providing weather information for a list of random users with different
latitudes and longitudes.

Installation
------------

To run this repo, follow these steps:

1. Clone the repository:

`git clone https://github.com/hweihwang/weather-info.git`

2. Navigate to the project directory:

`cd weather-info`

3. Make the `make.sh` script executable:

`chmod +x ./make.sh`

4. Run the script:

`./make.sh`

5. Wait for docker to build the images and start the containers. Normally,
   it may take about 5 minutes the first time you run it.


6. Your application should now be running at `http://localhost:13000`

Prerequisites
-------------

Before running this repo, ensure that you have Docker installed on your system.

Service details
---------------

- We are using laravel octane to serve the backend service. While service bootstrap once and keep in memory for the next
  incoming requests. We also have workers and task workers to handle multiple requests at the same time. Which are a
  huge performance boost
  for the application.

- We facilitate the weather information from the third party weather apis which are by default https://www.weatherapi.com
and https://openweathermap.org. The high availability of the weather apis is achieved by using chain of responsibility 
pattern, when one of the weather apis is down, the next one will be used to fetch the weather information. The default
NULL weather data provider would be used if all the weather apis are down.

- Redis is used as a cache driver for the application. The cache ttl is set to 30 minutes. Cache key is built based on
  the latitude and longitude of the user.

- We are running a cron job to fetch the weather information from the weather api every 5 minutes. The cron job is
  running in a separate container.

- Queue is used to invalidate the cache for the weather information. The queue is running in a separate container.

Technologies Used
-----------------

- Docker
- Laravel
- Laravel Octane
- Redis
- MariaDB
- Vue.js
- TailwindCSS
- Vite