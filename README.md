# Laravel - MHRA Project

## Prerequisites

- PHP \>= 8.1
- Git [(download)](https://git-scm.com/downloads)
- Composer [(download)](https://getcomposer.org/)
- XAMPP, WAMP, MAMP, or any other local server stack (**[XAMPP](https://www.apachefriends.org/download.html) is recommended** for Windows Users)

## Installation Steps

1. **Open a Terminal/Console and clone the repository:**
    ```sh
    git clone -b project03 https://git.brainster.co/Angel.Dimov-FS15/BrainsterProjects_AngelDimovFS15.git project
    cd project
    ```

2. **Install PHP dependencies:**
    ```sh
    composer install
    ```

3. **Copy the `.env.example` file to `.env`:**
    ```sh
    cp .env.example .env
    ```

4. **Generate the application key:**
    ```sh
    php artisan key:generate
    ```

5. **Create a database using phpMyAdmin (if using XAMPP / [tutorial](https://www.youtube.com/watch?v=co-xyHRdHRg)):**
    - Run XAMPP and start the Apache and MySQL services
    - Open your browser and navigate to `http://localhost/phpmyadmin`
    - Click on the `Databases` tab
    - Enter a name for your database in the Database Name field (e.g. `project`)
    - Click on the `Create` button


6. **Configure your database in the `.env` file:**
    ```env
    DB_CONNECTION=mysql (IMPORTANT: must be mysql)
    DB_HOST=127.0.0.1 
    DB_PORT=3306 (default port for MySQL)
    DB_DATABASE=your_database (whatever you named your database)
    DB_USERNAME=your_username (default username is root)
    DB_PASSWORD=your_password (default password is empty)
    ```

7. **Run the database migrations:**
    ```sh
    php artisan migrate
    ```

8. **Run the database seeders:**
    ```sh
    php artisan db:seed
    ```

9. **Start the development server:**
    ```sh
    php artisan serve
    ```
   

The project should now be up and running. Open your browser and navigate to `http://127.0.0.1:8000` or whatever adress the last step gave you, to see your application.
    
#### Hard-Coded Admin Credentials   
    Email: admin@mail.com
    Password: admin
    
