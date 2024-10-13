# Covid Vaccination App

This application is for the Covid 19 Vaccination Program.

## Features

- Registration
- Add new vaccination center
- Schedule vaccination
- Search vaccination status

## Installation
Go to folder/crate a folder that you want to install the application.

Open command prompt. and run below commands.

`git clone https://github.com/cserobiul/covid-vaccination-app.git`

`cd covid-vaccination-app`

`composer update`

create a database 'name as your choice' in your mysql database.
create a `.env` file at root folder and add database credentials in it.
Credentials will be as follows:

```php 
DB_CONNECTION=mysql 
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=covid_vaccination_app // db name as your choice, must be create first 
DB_USERNAME=root        // as per your settings
DB_PASSWORD=        // as per your settings

```
run `php artisan migrate:fresh --seed`

run `php artisan serve`

## How to use
### Registration Instruction
1. Go to http://localhost:8000 from any browser
2. You are redirected to registration page.
3. Fill up the form.
4. * mark fields are required
5. Click on Register button.
6. If you are not previously registered using NID and Email address You got successfully registered message. 
Otherwise, you will get validation errors.

### Search Instruction
1. If you are already registered, you can check your status from Search Page.
   http://localhost:8000/search
2. Input your valid NID number that you give during registration.
3. Click on Search button.
4. You will get your vaccination status.
5. The statuses can be `Not registered`, `Not scheduled`, `Scheduled`, `Vaccinated`. Consider the following when showing the statuses after the search:
   - If you are not registered yet, Show `Not registered` status along with a link to the ‘registration’ page.
   - If your vaccination date is scheduled, show `Scheduled` status along with the scheduled date.
   - If you are registered but not scheduled for vaccine yet, show `Not scheduled` status.
   - Assume that you will take your vaccine on your scheduled date. Show the `Vaccinated` status if the scheduled date is passed.

## Backend Mechanism
1. When user registers, it will create a new user in the database with schedule date by following criteria:
   - Users can’t register twice by using same email and NID number
   - Pre-populated 10 vaccination center will be created when `seed` command is run.
   - Schedule day will be tomorrow or later based on FIFO and vaccination center capacity.
   - Send notification email to user at 9PM before the night of the scheduled vaccination date.
   - Schedule vaccination only for weekdays (Sunday to Thursday).
2. Using laravel job, command, queue for email notification. 

## SMS Notification

At future time you can send SMS notification by following instructions:
Assume we use twilio for SMS notification.

1. First Install twilio by using below command

    `composer require twilio/sdk`

2. Open the VaccineReminderNotification.php file
3. add 'twilio' at return array of via method such that `return ['mail','twilio'];`
4. Create a toTwilio method to send SMS

```php
public function toTwilio($notifiable)
    {
        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

        $twilio->messages->create(
            $this->user->phone, // Phone number of the user
            [
                'from' => config('services.twilio.from'),
                'body' => ''Reminder:'. $this->user->name .', Your vaccine is scheduled on ' . $this->scheduledDate . ' at ' . $this->center,
            ]
        );
    } 
```
5. Add 'twilio' configuration in .env file
 
```php
TWILIO_SID=your-twilio-sid
TWILIO_AUTH_TOKEN=your-twilio-auth-token
TWILIO_PHONE_NUMBER=your-twilio-phone-number

```

6. create a config file name services at `config/services.php`
7. Add this code in this file
```php
'twilio' => [
    'sid' => env('TWILIO_SID'),
    'token' => env('TWILIO_AUTH_TOKEN'),
    'from' => env('TWILIO_PHONE_NUMBER'),
],

```

## How to test this application
1. Go to http://localhost:8000/registration
2. Fill up the form and click on Register button.
3. Go to database and check the user table.
4. open cmd/command prompt/terminal or bash and run `php artisan schedule:list` command to check the schedule table.
5. run `php artisan queue:work` command to run the queue.
6. to instantly test email send or not by using the application, 
   1. Change sms sending time `21:00` to another time that you want from AppServiceProvider.php file
   ` $schedule->command('vaccine:reminder')->dailyAt('21:00');`
   2. run `php artisan schedule:run` command. 
7. You can setup email configuration at https://mailtrap.io/
    configuration demo

```php
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=                // you may get when create an account at mailtrap.io
MAIL_PASSWORD=                 // password also get from mailtrap.io 
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="no-reply@covidvaccination.com"
MAIL_FROM_NAME="${APP_NAME}"
```


## Note
1. At registration page we collect user dob and gender for future notify another type of vaccination based on gender and dob. 
2. At registration page we collect phone number for future SMS notification.
3. Created laravel notification system for both email and sms notification(sms notification for future). 

