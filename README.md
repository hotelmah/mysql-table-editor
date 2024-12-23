## About
Welcome to a fancy MySQL Table Editor (MTE) web application. This package is considered a project and not a library. The project uses the PHP MySQLi 8.0 database extension which is downloaded as a dependency.

I have not been able to find a good MySQL Table Editor web application that is open source. Thus, I hope this project gains some traction. Due to this web application being a project and not a library,
I need some help to figure out how to package it in order to be incorporated into another project.

This project does have 3x dependencies, which are listed below.


## Notice
- There is no built-in authentication mechanism. Thus, please ensure such mechanism is in place.
- The CSS and Javascript files are rewritten to disk on every refresh. This is not very efficient, but useful if you edit the table config file via the main screen.


## Screenshot
![MTE Screenshot](screenshot.png?raw=true "MySQL Table Editor v2 Screen Shot")


##  Features
- Each table has to be setup up using the form and possibly edited manually if a mistake was made.
- Add, View, Edit, and Delete (CRUD) records of a table.
- Pagination: set the number of records per page.
- Sort ascending/descending by field name.
- Search by any field.
- An edit button is provided to load the text of the table config file where you can edit the table config file in the browser.
- A new table can be created by launching the form from the main screen.
- Switch between all the tables that have been configured.
- Show specific fields in list view and add/edit view.
- Set specific fields in add/edit view that are required.
- Map the field names of the table to something you want to see in the view/presentation. Visible names can be set for both list view and add/edit views.
- Only one primary key per table and one table at a time can be viewed.
- There is a help texts for each field. This can be seen in add/edit view. This config item must be manually setup. Use the edit button to access.
- The lookup table has not yet been used or tested.


## Setup (Important)
- Please edit the config.server.constants.php file in the src folder of the hotelmah/mysqli-wrapper dependency manually. The database connection properties are read from this file.
- There is no automated setup for this.


## Dependencies
These libraries are downloaded by the project as dependencies:
- hotelmah/mysqli-wrapper
- hotelmah/ModeliXe (a light-weight template engine)
- hotelmah/write-file


## Test File
- A test file is not included.
- This is because there is no test database server and sample database to connect to.


## In the Project Root
- run the index.php file in the project root.
- the index.php file will launch a form that will write a new table config file.
- After a table config file is found, index.php will redirect to it.


## Files Not Included in Packagist Package
- *.gitattributes*
- *screenshot.png*


## Installation - Composer
- run this command in your project root:

`
composer create-project hotelmah/mysql-table-editor .
`

- NOTE: include the "." at the end. This will install the package in the current folder.
- Alternatively, you can change the "." to a folder name and the package will be installed into that sub folder.
- NOTE: Installing as a library using the "require" keyword does not work because the index.php and html assets are buried inside the vendor folder. I can use help to figure out a way to have the assets and index.php file populate in the project root folder like the "create-project" keyword does, or be converted to MVC pattern.
- There is no need to manually create/update a composer.json file in your project root since this command does it automatically.
- The package is listed on Packagist, but is hosted on GitHub where the source is pulled from.
- See setup section above.


## Installation - Manual
- No support is provided for manual setup.


## Feedback
- Forks and Pull Requests are welcomed.
- Suggestions and comments for improvement are requested.
- Thank you for reading!


## Future Updates for improvement
- In the main class, there is still a mixture of HTML markup and application logic.
- Fields of the class are not encapsulated using get/set properties.
- Add an authentication mechanism.
- If packaged as a library, how can I encapsulate the HTML templates and other assets such that they can be called from the vendor src folder or be used in a MVC pattern?
- Checking for proper design such that this project is effective in an MVC or framework construct.
- I would like to integrate SQLite3 into this project since I already have a SQLite3 wrapper library.
- Update the CSS and Javascript writing to disk every time so that it is more efficient.


## License
- MIT License.
