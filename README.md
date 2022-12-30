<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# PhtogramLaravel
My Laravel project simulates an Instagram-like social network, featuring likes, comments, a CRUD system, and the use of artificial intelligence to generate tags for images. It is built using the Laravel framework.

## Features
- **Likes:** users can like and unlike posts
- **Comments:** users can leave comments on posts
- **CRUD system:** users can create, read, update, and delete their posts
- **Image tagging:** artificial intelligence is used to generate tags for images

## Technology
- [Laravel](https://laravel.com/) - The web framework used for the project.
- [Imagga API](https://imagga.com/) - The artificial intelligence API used for generating tags for images.

## Installation
To install and run this project, you will need to have PHP and Composer installed on your machine. Once you have these dependencies set up, you can follow these steps:
1. Clone the repository to your local machine
2. Navigate to the project directory and run `composer install` to install the project dependencies
3. Create a new database and configure your database credentials in the `.env` file
4. Run the migrations and seed the database with sample data using the following commands:
    - `php artisan migrate`
    - `php artisan db:seed`
5. Start the Laravel development server using the command `php artisan serve`

## Contributing
If you would like to contribute to this project, please fork the repository and create a new branch with your changes. Once you are ready to submit your changes, you can create a pull request for review. 
