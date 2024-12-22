## About
Welcome to a fancy MySQL Table Editor web application. This package is a considered a project and not a library. The project uses the PHP MySQLi 8.0 database extension which is downloaded as a dependency.

I have not seen many good MySQL Table Editor web applications that are open source. Thus, I hope this project gains some traction. Due to this web application being a project and not a library,
I need some help to figure out how to package it in order to be incorporated into another project.

This project does have 3x dependencies, which are listed below.


##  Features
- Each table has to be setup up using the form and possibly edited manually if a mistake was made.
    - View records of a table.
    - Edit individual records of a table.
    - add new records to a table.
    - pagination: set the number of records per page.
- A table config file can be editied from the main screen.
- A new table can be created by launching the form from the main screen.
- Switch between all the tables that have been configured.


## Setup (Important)
- Please edit the config.server.constants.php file in the src folder of the hotelmah/mysqli-wrapper dependency manually. The database connection properties are read from this file.
- There is no automated setup for this.


## Dependencies
- These libraries are downloaded by the project as dependencies:
    - hotelmah/mysqli-wrapper
    - hotelmah/ModeliXe (a light-weight template engine)
    - hotelmah/write-file


## Test File
- A test file is not included.
- This is because there is no test database server and sample database to connect to.


## In your Project
- run the index.php file in the project root.
- the index.php file will launch a form that will write a new table config file.


## Installation - Composer
- run this command in your project root:

`
composer create-project hotelmah/mysql-table-editor
`

- There is no need to manually create/update a composer.json file in your project root since this command does it automatically.
- The package is listed on Packagist, but is hosted on GitHub where the source is pulled from.
- See setup section above.


## Installation - Manual
- No support is provided for manual setup.


## Feedback
- Forks and Pull Requests are welcomed.
- Suggestions and comments for improvement are requested.
- Thank you for reading!

## Future Updates
There are a few items that can use improvement:
- In the main class, there is still a mixture of HTML markup and applicaiton logic.
- Fields of the class are not encapsulated using get/set properties.
- Checking for proper design such that this project is effective in an MVC or framework construct.


## License
- MIT License.
