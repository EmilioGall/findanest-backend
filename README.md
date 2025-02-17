# FindNest Backend

The backend for the FindNest platform, a comprehensive application designed for searching and managing apartment listings. It provides the necessary APIs, database configurations, and integrations to support the FindNest ecosystem, enabling users to search apartments based on various criteria and facilitating interactions such as bookings and payments.

## Table of Contents

- [Dependencies](#dependencies)
- [Features](#features)
- [Environment Variables](#environment-variables)
- [Installation](#installation)
- [Services](#services)
- [Milestones](#milestones)
- [Contributing](#contributing)

## Dependencies

The project is built with the following main technologies:

- **Laravel Framework** (PHP): The backend framework for API development.
- **MySQL**: Database for storing application data.
- **Redis**: Cache layer for optimizing performance.
- **Mailtrap**: Used for email services in development.
- **Braintree**: Payment gateway integration.
- **TomTom API**: Geolocation services for handling address-based searches.

## Features

1. **User Authentication**:
   - Secure login and registration.
   - Role-based access control.

2. **Apartment Listings**:
   - APIs for adding, updating, and retrieving apartment data.

3. **Search Capabilities**:
   - Filter apartments by location, price, and amenities.

4. **Booking and Payment**:
   - Integration with Braintree for processing apartment bookings.

5. **Email Notifications**:
   - Automated email confirmations for user actions like bookings.

## Environment Variables

The application uses a `.env` file to configure sensitive data. Below are key environment variables:

- `APP_URL`, `APP_KEY`, `DB_*`: Core application and database settings.
- `MAIL_*`: SMTP configurations for email services.
- `TOMTOM_API_KEY`: For geolocation services.
- `BRAINTREE_*`: For handling payment transactions.

Refer to the `.env.example` file for a complete list of required variables.

## Installation

To set up the project locally:

1. Clone the repository:
   ```bash
   git clone https://github.com/EmilioGall/findanest-backend.git
   cd findanest-backend
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up the environment:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Migrate the database:
   ```bash
   php artisan migrate
   ```

6. Start the server:
   ```bash
   php artisan serve
   ```

## Services

The project integrates with the following external services:

- **TomTom API**: Geolocation for address and map-related queries.
- **Braintree**: Payment processing for bookings.
- **Mailtrap**: Email service for development and testing.

## Milestones

1. **Database Schema Design**:
   - Define and implement models and relationships for users, apartments, and bookings.

2. **API Development**:
   - Implement endpoints for CRUD operations on apartments.

3. **Integration**:
   - Connect frontend functionalities with backend APIs.

4. **Testing**:
   - Unit tests for core functionality and integrations.

## Contributing

Contributions are welcome! Follow these steps to contribute:

1. Fork the repository.
2. Create a feature branch:
   ```bash
   git checkout -b feature/your-feature
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add new feature"
   ```
4. Push to the branch:
   ```bash
   git push origin feature/your-feature
   ```
5. Open a pull request.

For more details, visit the [GitHub repository](https://github.com/EmilioGall/findanest-backend). 

---

Happy coding!
