

## Install tutorial

## Step 1:
    git clone repo, cd into containing folder

## Step 2:
    Ensure that you copy and paste the contents of `.env.example` into `.env`

## Step 3:
    Run the following commands in order
    
    `composer install` (if you dont have it installed go to: https://getcomposer.org/download/)
    `npm i`
    `./vendor/bin/sail up` 
    `npm run dev`

    A laravel test container and a my-sql container should now be running
## Step 4:
    In a new shell tab run the following 
    `.vendor/bin/sail artisan migrate`
## Step 5:
    Enjoy!
