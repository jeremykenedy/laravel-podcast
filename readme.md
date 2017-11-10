### Laravel Podcast is Laravel 5.3 web app that enables you to manage RSS feeds for your favorite podcasts and listen to the episodes in a seamless UI and User Authentication.

[![License](http://jeremykenedy.com/license-mit.svg)](https://raw.githubusercontent.com/jeremykenedy/laravel-material-design/master/LICENSE) [![Build Status](https://travis-ci.org/jeremykenedy/laravel-podcast.svg?branch=master)](https://travis-ci.org/jeremykenedy/laravel-podcast)

#### READY FOR USE!

Built on Laravel 5.5, Bootstrap 3.6, and easily customizable with SASS. Change the entire theme with by the single color variable `$baseThemeColor` listed in `/resources/assets/sass/_variables.scss` and make it your customized version instantly. Includes form input validation, error handling, routing, ajax forms, configured gulpfile, and more.

###### A [Laravel](http://laravel.com/) 5.5.x with [Bootstrap](http://getbootstrap.com/) 3.6.x project.
| Laravel Podcast Features  |
| :------------ |
|Automatically Pulls Podcasts Images, Titles, Dates, and Descriptions of episodes|
|Mark your favorite episodes, accessible via the `podcasts/favorites` link|
|New episodes published by podcasts are updated automatically|
|Search for episodes from the title and description|
|Mark all previous episodes in a podcast as read|
|Mark episodes you have listened to as read|
|Listen to Podcast and RSS Feeds|
|Modals for action confirmation|
|Download Podcast/RSS Episodes|

| Built in Laravel Features  |
| :------------ |
|Uses [MySQL](https://github.com/mysql) Database and include migrations and seeds|
|Uses [Artisan](http://laravel.com/docs/5.5/artisan) to manage database migration, schema creations, and create/publish page controller templates, and update schedules|
|Dependencies are managed with [COMPOSER](https://getcomposer.org/)|
|Laravel Scaffolding **User Authentication**|

### Installation Instructions

1. Run `sudo git clone https://github.com/jeremykenedy/laravel-podcast.git laravel-podcast`
2. Create a MySQL database for the project
    * ```mysql -u root -p```, if using Vagrant: ```mysql -u homestead -psecret```
    * ```create database laravelPodcast;```
    * ```\q```
3. From the projects root run `cp .env.example .env`
4. Run `sudo composer install` from the projects root folder
5. From the projects root folder run `sudo php artisan key:generate`
6. From the projects root folder run `sudo php artisan migrate`
7. From the projects root folder run `sudo composer dump-autoload`
8. From the projects root folder run `sudo chgrp -R www-data storage bootstrap/cache`
9. From the projects root folder run `sudo chmod -R ug+rwx storage bootstrap/cache`

##### Rebuild Front End Assets (optional)
1. From the projects root folder run `sudo npm install`
2. From the projects root folder run `sudo gulp`

##### Build Cache (optional)
1. From the projects root folder run `sudo php artisan config:cache`

#### View the Project in Browser
1. From the projects root folder run `php artisan serve`
2. Open your web browser and go to `http://localhost`

* Manually update new episodes by navigating to route ```podcasts/auto-update```

###### Seeds
1. Seeded Users
   * Username: `Admin`
   * E-mail: `jeremykenedy@gmail.com`
   * Password: `password`

### laravel-podcasts URL's (routes)
* ```/```
* ```/login```
* ```/logout```
* ```/register```
* ```/password/reset```
* ```/podcast```
* ```/podcasts```
* ```/podcast/search```
* ```/podcasts/manage```
* ```/podcasts/player```
* ```/podcasts/settings```
* ```/podcasts/favorites```
* ```/podcasts/auto-update```

### Screenshots
![Home/Listen Page](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-podcast/1-home.jpg)
![Manage Page](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-podcast/2-manage.jpg)
![Favorites Page](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-podcast/3-favorites.jpg)
![Search Results Page](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-podcast/4-search.jpg)
![Login Page](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-podcast/5-login.jpg)
![Register Page](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-podcast/6-register.jpg)
![Mark as Read Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-podcast/7-modal-read.jpg)
![Mark All as Read Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-podcast/8-modal-all-read.jpg)
![Add RSS Feed Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-podcast/9-modal-add.jpg)
![Delete RSS Feed Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-podcast/10-modal-delete.jpg)

### Laravel Podcast License
Laravel-Podcast is licensed under the MIT license. Enjoy!

* Orignal Concepts from [Podcastwala Github Respository](https://github.com/modestkdr/Podcastwala)
