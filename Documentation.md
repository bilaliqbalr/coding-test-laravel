
## Installation
* Clone the repository
* Run `composer install`
* Run `php artisan key:generate`
* Run `php artisan migrate`
* Run `php artisan db:seed`
* Run `php artisan serve`
* Go to `http://localhost:8000`

## Usage
Go to http://localhost:8000/customers to see the list of customers along with the filters.

## Approach Used
Firstly, I added all required indexes to the database to make the query faster. 

And as we may have more data in the future, so instead of applying filter on all columns at once (which will reduce 
the overall performance of the application). Right now I am applying filter on only that column which is selected (or filled) by the user, 
that way we can reduce the load on the database and make the search results faster.

Before filtering data, I added validation step to avoid unwanted data being passed to the query, which may cause SQL Injection.

## Other ways to improve search
* Apply full-text search on the name column
* Usage of Laravel Scout for full-text search
* Usage of Elastic Search
