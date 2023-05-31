# ESC Project Introduction

Course: Software Engineering

Project name: ESC (Epoka Student Community)
Developed by: Klaudia Rapaj

Problem: Students often find it difficult to reach out to each other, especially when they have no contacts with each other. Students of different departments and course programs struggle to find answers to common questions they might have because of inability to spread/communicate this information to others. Therefore, there is a need of a designed community for university's students to use in order to stay connected, help each other, grow network and make the most out of their university days.

Aim: Enhance the students' engagement and experience, solve student problems, motivate them into studying while having fun and staying connected.

Main objectives: Be able to build a dynamic and user-friendly web application for students to communicate and find a space where they can share their ideas related to anything about Epoka.

Description of the application: A web application that merges features of reddit, twitter and slack in order to make it possible for students to have a variety of permissions to make posts, join forums from any department, find materials or answers to their questions, search for already posted information, filter the content etc. The application with be specifically designed for Epoka students only therefore no one else can have access to it.



# **ESC Project**

Welcome to my Software Web Application in Laravel. This project aims to build a bringe of communication between the students through various features and functionalities.

## **Table of Contents**
Project Description\
Features\
Getting Started\
Installation\
Usage\
Contributing\
License\

 ## **Project Description**
ESC is a social networking website for students where they can connect, share information, participate in discussions etc. It provides a forum for students to interact with each other, exchange ideas, and foster community.\

The project leverages PHP's power and flexibility to deliver a robust, scalable solution. It incorporates several Laravel packages to streamline development.

## **Features**
The Student Community Laravel Project offers the following key features:

User Registration and Authentication:\
Students can register and create an account.\
Secure email verification, authentication and password management.\
Difference between student roles (admin & regular users).
    
Student Profiles:\
Students can create and manage their profiles.\
Profile pictures, contact information, personal details.\
Academic background, interests, and skills.
    
Forums:\
Students can join forums based on the degree they are interested in.\
Create, read, update, and delete posts.\
Like, Comment, Bookmark on posts and engage in conversations.
    
Notifications:\
Notifications for new comments, likes, follows.

Feedback:\
Students can leave feedback to the development team for future suggestions and complaints.

Bookmarks:\
Students can bookmark posts in a collective page.
    
Admin Panel:\
Administrative dashboard to manage users, posts, forums, feedbacks.\
Admins can moderate content, users, and perform other administrative tasks.

## **Getting Started**
To get started with the project, follow the installation instructions below.

## **Installation**
1. Clone the project repository:
```
git clone <https://github.com/klaudiarapaj/ESC-Project.git>
```
2. Install project dependencies using Composer:
```
composer install
```
3. Create a new .env file from the .env.example file:
```
cp .env.example .env
```
4. Generate a new application key:
```
php artisan key:generate
```
5. Configure the database settings in the .env file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=esc
DB_USERNAME=root
DB_PASSWORD=
```
6. Run the database migrations:
```
php artisan migrate
```
7. Start Apache and MySQL in XAMPP

8. Start the development server:
```
php artisan serve
```
```
npm run dev
```
9. Access the application by visiting http://127.0.0.1:8000/ in your web browser.


## **Usage**
Once the project is up and running you can start using the web application. You can begin by creating an account or logging in if you already have one. Explore the different features and functionalities that the website offers. Participate in forum discussions, share resources, engage with other students and spread the word.

The project's code is developed using Laravel's conventions, so you can easily extend and customize the application according to your requirements. Refer to Laravel's documentation for more information on working with the framework and making modifications to the project.

## **Contributing**
I welcome contributions to my project. If you would like to contribute, please follow these steps:

Fork the repository.
Create a new branch for your feature or bug fix.
Make the necessary changes and commit them.
Push your changes to your forked repository.
Submit a pull request detailing your changes.

## **License**
The project is open-source and released for academic purposes.






