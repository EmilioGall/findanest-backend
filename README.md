# FindNest Backend

A RESTful API built using Laravel and Node.js that provides a set of endpoints for searching, retrieving, and managing apartments. The API also includes a backoffice interface for administrators to manage apartments, bookings, and user accounts.

## Table of Contents

- [Dependencies](#dependencies)
- [Features](#features)
- [Services](#services)
- [Installation](#installation)
- [Milestones](#milestones)
- [Contributing](#contributing)

## Dependencies

* PHP 7.4+
* Composer
* Node.js 14.17+
* NPM
* MySQL 8.0+

## Features

Search Functionality

* Users can search for apartments by location, price, and other filters.
* Results are displayed in a list view, with options to filter by distance, price, and availability.

Booking System

* Users can book apartments sending a message directly from the search results page.
* Users will receive a confirmation email with the booking details.

User Profiles

* Users can create and manage their profiles, including adding and editing their contact information.

Apartment Listings

* The API displays a list of available apartments that match the user's search criteria.

Apartment Details

* Users can view detailed information about each apartment, including its description, images, and amenities.

Backoffice Interface

* Administrators can create, read, update, and delete apartments.
* Administrators can view and manage bookings.
* Administrators can manage user accounts, including creating, reading, updating, and deleting users.

## Services

* **MySQL**: For database storage.
* **PHP**: For server-side scripting.
* **Node.js**: For API endpoints.

## Installation

To install the FindNest Backend, you can use npm by running the following commands:

```bash
npm install findanest-backend
```

## Milestones

Milestone 1

* Create a RESTful API endpoint to retrieve a list of all available apartments.
  
Milestone 2

* Implement authentication and authorization for the API.
  
Milestone 3

* Integrate the backoffice interface with the API to enable administrators to manage apartments and bookings.

Milestone 4

* Update the API to return real-time updates whenever an apartment's availability changes or when a new apartment is added.

## Contributing

We welcome contributions! If you're interested in contributing to the project, please follow these steps:

1. Fork the repository.
2. Create your feature branch (`git checkout -b feature/YourFeature`).
3. Commit your changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/YourFeature`).
5. Open a pull request.

---

For more information and updates, check out the project repository on [GitHub](https://github.com/EmilioGall/findanest-backend). 

---

Happy coding!




Here is the updated README.MD file with the backoffice functionality:

**FindNest Backend**
================

The FindNest backend is a RESTful API built using Laravel and Node.js. It provides a set of endpoints for searching, retrieving, and managing apartments, as well as a backoffice interface for administrators.

**Dependencies**

* PHP 7.4+
* Composer
* Node.js 14.17+
* NPM
* MySQL 8.0+

**Setup**

1. Clone the repository: `git clone https://github.com/EmilioGall/findanest-backend.git`
2. Install dependencies: `composer install` and `npm install`
3. Create a database and configure the `.env` file accordingly
4. Run the migration: `php artisan migrate`
5. Start the server: `php artisan serve`

**API Endpoints**

The FindNest API provides the following endpoints:

* `GET /apartments`: Retrieves a list of all available apartments.
* `GET /apartments/:id`: Retrieves a specific apartment by its ID.
* `POST /bookings`: Creates a new booking for an apartment.
* `GET /bookings`: Retrieves a list of all bookings made by the user.

**Backoffice Interface**

The FindNest backoffice interface is accessible at `/backoffice` and provides the following features:

* **Apartment Management**: Create, read, update, and delete apartments.
* **Booking Management**: View and manage bookings.
* **User Management**: Manage user accounts, including creating, reading, updating, and deleting users.

**Security**

The FindNest API uses basic authentication for secure communication between clients and servers. You can obtain an API token by sending a POST request to `/api/token` with your username and password.

**Login Credentials**

The backoffice interface uses the following login credentials:

* Username: `admin`
* Password: `password`

**Contributing**

We welcome contributions to FindNest! If you'd like to contribute, please fork the repository and create a pull request with your changes.

**License**

FindNest is licensed under the MIT License.

I hope this updated README.MD file helps you understand how to use and contribute to the FindNest backend!
