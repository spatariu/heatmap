# Heatmap
Heatmap Microservice

## Installation:
- clone the repository and open a terminal for that location
- install the Docker app
- go to the `laradock` folder and run `docker-compose up -d nginx mysql phpmyadmin workspace`
- run `docker ps` to check the name of the workspace container and get inside it with `docker exec -it laradock_workspace_1 bash`
- run `php artisan migrate:fresh --seed` to init the db
- run `php artisan passport:install` for the auth service
- install Postman for easily testing the API

## Test the REST API

### 1. Register an account at http://localhost/api/register setting the required params from the screenshot

![image](https://user-images.githubusercontent.com/3978400/131658133-2d158859-5a30-4b12-9e70-2b646af88784.png)

### 2. Login on http://localhost/api/login setting the required params from the screenshot

![image](https://user-images.githubusercontent.com/3978400/131658672-5bcc66d4-c72e-4449-879b-045a83288584.png)

### 3. After the login copy the generated token and set it for all the next requests like this:

![register](https://user-images.githubusercontent.com/3978400/131660944-da1dab10-2073-400a-842b-9f227f1433db.jpg)

### 4. Create links here http://localhost/api/links setting the required params from the screenshot

![register](https://user-images.githubusercontent.com/3978400/131661280-4267aff4-107e-4bbe-8e46-da3d15ef1ba4.jpg)

### 5. Get the link hits in a time interval here http://localhost/api/links?link=https://www.emag.ro/&from=2021-08-01&to=2021-08-31

![register](https://user-images.githubusercontent.com/3978400/131661816-58d1013f-48ae-4fd7-b01f-02d0b1e78558.jpg)

### 6. Get the page hits in a time interval here http://localhost/api/pages/2021-08-01/2021-08-31

![register](https://user-images.githubusercontent.com/3978400/131663189-c66d6e76-9729-4c56-99d5-07dce7efed22.jpg)

### 7. Get the customer's journey here http://localhost/api/journey/1

![register](https://user-images.githubusercontent.com/3978400/131662394-e54a3e5d-8952-4d41-a632-713148aae28f.jpg)

### 8. Get the customers with the same journeys here 

![register](https://user-images.githubusercontent.com/3978400/131662591-2d4d3b5d-7619-40bc-a6d2-4773221905c9.jpg)

## Automated testing

- run the tests with `composer test` (only one test was created for demo purposes)

![register](https://user-images.githubusercontent.com/3978400/131665809-e327d36d-18e4-4e16-b518-e1a9b7c202f4.jpg)


*This is just a demo REST API, if it would be deployed to production the security has to be improved (hiding passwords and so on)!*
