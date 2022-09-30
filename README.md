# Welcome to thee Medical Database & API

## Description

This project contains all scripts to fetch and store data as well as a fully functioning API to fetch this data.

The project is based on **PHP 8.1**,  **[API-Platform 2.5](https://api-platform.com/docs/v2.5/distribution/)** and **[Symfony 5.4](https://symfony.com/)**

Live API is available at https://data.instamed.fr

5 type of data are currently available :

##### RPPS Data
- The RPPS (Répertoire Partagé des Professionnels de Santé) contains all the data of French health professionals 

##### Drugs data
- The drugs data contains all the data of allowed drugs on the French Market

##### Diseases data
- The diseases data contains all the data from the OMS CIM-10 database

##### Allergens data
- The allergens data contains all the alergens that are known

##### CCAM data
- The CCAM data contains all the medical acts and their reimbursment rate by the social security

##### NGAP data 
- The NGAP data contains a database of medical acts

## Installation

### Docker Setup

**Prerequisites:**

- Have docker installed
- Have docker-compose installed

**Setup with test data:**

Duration: ~10/15 minutes

```
$ make setup-dev
```

## Development
To run the docker environment you can start the docker server with the following command : 
```shell
docker-compose up
````

Then here are some useful commands
````shell
# Starts a bash session in the container
make shell

# Install a composer package
make composer-require package='name/of/your/package'
````


## Tests
All code is tested using [phpunit](https://phpunit.de/)
All test files are in the *tests/* folder in 3 sub folders : 
* **Unit** : Contains all unit tests of the project
* **Integration** : Contains all the integration tests of the project
* **Functional** : Contains all the functional tests of the project

To run the tests, run the command 
````shell
make phpunit
````

# Exercise

The goal of this exercice is to add an **authentication system** inside this project using API KEY header verification

## Step 1 : Add a User Entity
With the help of [this documentation](https://symfony.com/doc/current/security.html#the-user), create a User Entity with the following properties : 
* id : uuid
* name : string
* email : unique string
* roles : array
* password : string
* plainPassword : string
* apiKey : string

The database update must be run using [doctrine migrations](https://symfony.com/bundles/DoctrineMigrationsBundle/current/index.html#usage). (The bundle is already installed & configured)

## Step 2 : Configure the security

## Step 2 : Add a new firewall
With the help of [this documentation](https://symfony.com/doc/current/security.html#the-firewall). you will configure the security.
#### Add new roles
2 roles should be added : 
* ROLE_CUSTOMER
* ROLE_ADMIN
The role `ROLE_ADMIN` should inherit the role `ROLE_CUSTOMER`

#### Configure the firewall
add a new firewall that will block all access to the routes following this path `/api/*`. The documentation available on `/api` should still be accessible with an anonymous access.

All roles are allowes to access the routes.

## Step 3 : Add a custom authenticator
With the help of [this documentation](https://symfony.com/doc/5.4/security/custom_authenticator.html), create a custom authenticator. This service will do the following : 
* Read the `X-Api-Key` header sent in the request
* Retrieve the existing user linked to this Api Key
* Authenticate the user using a `SelfValidatingPassport`

If any of these steps do not work properly, the authenticator **must** return a  `CustomUserMessageAuthenticationException` with the message *Missing or Invalid API KEY*

## Step 4 : Add user fixtures
With the help of [this documentation](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html), add custom fixtures to create 3 User Entities : 
* user 1 :
    * name : Admin
    * email : admin@instamed.fr
    * roles : [ROLE_ADMIN]
    * password : password
    * api-key : random 16 char long string
* user 2 :
    * name : Customer 1
    * email : customer1@instamed.fr
    * roles : [ROLE_CUSTOMER]
    * password : password
    * api-key : random 16 char long string
* user 3 :
    * name : Customer 2
    * email : customer2@instamed.fr
    * roles : [ROLE_CUSTOMER]
    * password : password
    * api-key : random 16 char long string

## Step 5 : Add functional tests
With the help of [this documentation](https://api-platform.com/docs/v2.5/core/testing/), and the existing tests, add a new file `tests/Functional/AuthenticationTest.php`. You will create an `AuthenticationTest` class extending the `ApiTestCase` class

Inside this file, you will add 3 tests :

* `testAuthenticationInvalidWithMissingApiKey` : It will test the case when no `X-API-KEY` header is sent in the request
* `testAuthenticationInvalidWithInvalidApiKey` : It will test the case the `X-API-KEY` header sent is invalid
* `testAuthenticationValid` : It will test the case the `X-API-KEY` header sent is valid

For this, you should use the existing functions declared in the `ApiTestCase` base class


