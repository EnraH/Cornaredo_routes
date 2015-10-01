# Cornaredo routes

The goal is an online platform to draw routes into a picture of a bouldering wall.
The structur is

* A Mysql Database containing all routes (set of two dimensional coordinates)
* An Ajax interface to visualize selected routes on a picture
* An Ajax interface to generate new routes using clicks on the picture -> retrieve coordinates and store them into the database
* Export function (pdf, jpeg) for selected routes

## MYSQL Database 

So far only set up locally containing the tables

  * routes
  * difficulties: translate difficulties to integer values
