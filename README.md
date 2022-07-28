# Desafio_Onesight_Backend
Onesight Challenge (Backend), using technologies such as PHP/Symphony and MySQL (MariaDB).

## Project Structure
The project was built using PHP, Symfony, MySQL (MariaDB), Docker.

## Project Installation and Startup
Initially, some prerequisites are needed to install the project:
- PHP
- Composer
- Docker
- Git
- Symfony CLI

After confirming that you have the prerequisites or have installed them, we now need to follow the installation steps:
- 1º git clone https://github.com/Uriel-David/Desafio_Onesight_Backend.git (clone repository locally)
- 2º composer install (use command in project root folder)

Successfully finishing these 2 commands the project will be installed correctly, now we need to run the project.
Even before running the project, we need to configure the environment variables, so we need to run the `composer dump-env dev` command,
so we will create a local file with the environment variables. In the generated file it will be necessary to change two variables:
- 'PASSWORD_DATABASE' => 'root' (database root user password, sample 'root')
- 'DATABASE_URL' => 'mysql://root:root@127.0.0.1:3306/events_app?serverVersion=8.0.30&charset=utf8mb4' (example string to connect to the database)

Now we can finally run our docker server and container:
- 1º docker compose up (if it fails check if the service is up or installed correctly)
- 2º Symfony serve:start (use this command after the entire container installation process is finished)

After that, just go to the url (http://127.0.0.1:8000) where the server is active and see the project running.

## Page Structure and Features
The project has basically 3 pages, index, create and update.
- Index: the admin can visualize all the events created, having the option to update the events or delete them.
- Create: It is possible to create events through a form and thus save the information in the database, to be visualized in the index.
- Delete: It is possible to update events through a form and thus approve the event and update the information in the database, to be visualized in the index.