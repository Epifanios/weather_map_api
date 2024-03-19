# Weather Map API


## Setup Application

1. Clone the repository running this command in your terminal:

    ``` git clone https://github.com/Epifanios/weather_map_api.git ```

2. Install Composer

    ``` composer install ```

3. Create ```.env``` file (dublicate .env.example) and update the following lines:

    ```dosini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

4. Generate Key Application

    ``` php artisan key:generate ```

5. Migrate Tables

    ``` php artisan migrate ```



## Use data from weather source

Click on the <a href="https://home.openweathermap.org/users/sign_up">Open Weather Map</a> and create new account. In your profile you should have the default API Key. Copied your API Key and add it in your .env file using this line:

```
API_KEY=your_api_key
```


## Execute Job

The job is about storing the data on your database when you call the api. 

1. First you have to update the following line in your ``` .env ``` file: 

    ```
    QUEUE_CONNECTION=database
    ```

2. For execute the job run this command on your terminal:

    ``` php artisan queue:work ```


## Testing Application

Run this command on your terminal:

``` ./vendor/bin/phpunit ```

