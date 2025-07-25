## Installation & Local Setup

1. **Clone the repository**
   ```sh
   git clone https://github.com/jbdev21/board.git
   ```

2. **Install PHP dependencies**
   ```sh
   # Make sure your are in the project directory
   composer install
   ```

3. **Install Node.js dependencies**
   ```sh
   npm install
   ```

4. **Copy and configure environment variables**
   ```sh
   cp .env.example .env
   # Edit .env as needed (e.g., database and email settings)
   ```

5. **Generate application key**
   ```sh
   php artisan key:generate
   ```

6. **Run database migrations with seeders**
   ```sh
   php artisan migrate --seed
   ```

7. **Start the development servers**
   ```sh
   php artisan serve
   ```

8. **Start scheduler locally which is collecting job posting expternally**
   ```sh
   php artisan schedule:work
   #Note: Its fetching every 3 hours so keep it running.
   ```
9. **Optional but recommended**
    Run the queue in the background for better performance especially for sending the email. Please QUEUE_CONNECTION to database and email credentials
   ``` 
    QUEUE_CONNECTION=database

    MAIL_MAILER=smtp
    MAIL_HOST={your email host}
    MAIL_PORT={your email port}
    MAIL_USERNAME={your email username}
    MAIL_PASSWORD={your email password>}
   ``` 
   ```sh
   php artisan queue:work
   #Note: Its fetching every 3 hours so keep it running.
   ```
   
   

10. **Access the application**
   - Visit [http://localhost:8000](http://localhost:8000) in your browser.
   - Access the admin<br>
    url: [http://localhost:8000/admin](http://localhost:8000/admin)<br>
    email: test@example.com<br>
    password: password


