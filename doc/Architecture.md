## 📘 Developer Documentation

### 1. Project Architecture Diagram

The core architecture diagram below illustrates the high-level structure of this custom PHP MVC framework. It follows a Layered Architecture approach, emphasizing clean separation of concerns across components.

- Routing Layer handles incoming HTTP requests and delegates to controllers based on route definitions.
- Controller Layer serves as the entry point for business logic and coordinates between services and HTTP responses.
- Service Layer encapsulates application logic and mediates between controllers and repositories.
- Repository Layer abstracts data persistence and interacts with the database through Doctrine ORM.
- Entity Layer defines the data models mapped to database tables.
- Middleware allows pre/post-processing of HTTP requests (e.g., authentication).
- Dependency Injection Container (via PHP-DI) manages class dependencies and configuration.
- Service Providers register and configure framework services (e.g., ORM, validators, exception handler).
- Validation Layer uses Respect/Validation for request input handling.
- Environment Configuration is loaded from .env to allow flexible config per environment (local, staging, production).

This modular design allows developers to build clean, maintainable, and testable backend applications with minimal boilerplate.

![Framework Architecture](php_mvc.png)

### 📘 Final Notes

This project demonstrates the foundational structure and design of a custom PHP MVC framework, inspired by modern backend architecture principles.

📌 Note:
Detailed documentation for the core components (such as routing engine, middleware execution flow, DI container internals, etc.) will be added in a future update under the /docs directory.

Stay tuned for deeper insights into how each part of the framework is crafted and how you can extend it for your use case.

Thanks for visiting! 🚀