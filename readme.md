### IAGREEK Application

This application is for the full web application that manages the documents and signing campaigns for Greek Life Organizations.

**Quick Brief:**
Web Server: Apache/Nginx
Framework: Laravel 5.4.*
Cloud Storage: AWS S3
Mail: Self-Hosted & Mailtrap for Development
Payment: Stripe
RDBMS: Postgres >= 9.6
Google: GOOGLE_PLACES_API


## To get started with development
_I assume you already have some kind of PHP + webserver setup_
- [ ] cd to working directory
- [ ] clone repo
- [ ] `composer install`
- [ ] `npm install`
- [ ] `cp env.example .env`
- [ ] `php artisan key:generate`
- [ ] Input keys and configs into env and make DB that matches name in `.env`
- [ ] `php artisan migrate`
- [ ] `php artisan db:seed`
- [ ] Go to localhost URL you're supposed to be hosting @
- [ ] `admin@iagreek.com` & `hello`

**NOTE:** When developing make sure you work on new branch name in style of `<issue#>-issue-short-name`
