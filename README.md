# Action Starter Kit
An opinionated Laravel FATLL stack website base. [Live Demo](https://action-sterter-kit.laravel.cloud/)

[![deploy](https://github.com/realpoke/action-sterter-kit/actions/workflows/deploy.yaml/badge.svg)](https://github.com/realpoke/action-sterter-kit/actions/workflows/deploy.yaml)
[![tests](https://github.com/realpoke/action-sterter-kit/actions/workflows/tests.yaml/badge.svg)](https://github.com/realpoke/action-sterter-kit/actions/workflows/tests.yaml)
<a href="https://herd.laravel.com/new?starter-kit=realpoke/action-stater-kit"><img src="https://img.shields.io/badge/Install%20with%20Herd-f55247?logo=laravel&logoColor=white"></a>

## Stack
- [FluxUI Pro](https://fluxui.dev/) – Premium UI component library for Livewire.
- [Alpine.js](https://alpinejs.dev/) – Minimal, reactive JavaScript framework for handling UI interactivity.
- [TailwindCSS](https://tailwindcss.com/) – Utility-first CSS framework for rapid, customizable design.
- [Laravel](https://laravel.com/) – Modern PHP framework for building robust websites.
- [Livewire](https://livewire.laravel.com/) – Full-stack framework for building dynamic interfaces in Laravel.

### Features
Full Laravel Authentication Flows, Two Factor Authentication, User Avatars, Session Management, Fully Tested, User Profile Page, Composer Script Automation, CI/CD & Auto Deploy, Action/Command Pattern, Mobile-Friendly, Dark Mode Support, Fully Translatable, Auto Language Picker, Fully Responsive Across Browsers.

## Development Setup

1. Clone the repo:
   - **Using GitHub Template**:

     Click "Use this template" on the [GitHub repo page](https://github.com/realpoke/action-starter-kit) to create a new repository and clone it.
   - **Manually**: 
     ```sh
     git clone https://github.com/realpoke/action-starter-kit.git
     cd action-starter-kit
     ```
   - **Laravel Installer**: 
     ```sh
     laravel new --using=realpoke/action-starter-kit
     cd action-starter-kit
     ```
    - **Laravel Herd**:
   
      <a href="https://herd.laravel.com/new?starter-kit=realpoke/action-stater-kit"><img src="https://img.shields.io/badge/Install%20with%20Herd-f55247?logo=laravel&logoColor=white"></a>

2. Set up and run the development environment:
   - **Initial Setup**: First time starting the development environment, use the setup script:
     ```sh
     composer setup
     ```
   - **For non-Pro Flux users**:
     ```sh
     composer setup:free
     ```
   - **Start the development environment**: After the initial setup, run this to start the development environment:
     ```sh
     composer dev
     ```

## GitHub Setup & Secrets

1. Create a GitHub repository.

2. Add the following repository secrets:
   - `LARAVEL_CLOUD_API_TOKEN` → Your Laravel Cloud Deploy Hook URL
   - `FLUX_USERNAME` → Your email for Flux Pro
   - `FLUX_LICENSE_KEY` → Your Flux Pro license key

3. Push your code:
   ```sh
   git remote add origin https://github.com/your-username/your-repo.git
   git branch -M main
   git push -u origin main
   ```

## Deployment to Laravel Cloud

1. Make sure all tests pass

2. Simply push to the `main` branch on Github

## Technologies

This project uses various technologies and tools for development, testing, and deployment automation. Here are the key components:

### Package Managers & Runners
- **Composer**: For PHP dependency management and running custom scripts.
- **Bun**: A fast JavaScript bundler and package manager, used for managing frontend dependencies and running Vite.

### Development Flow
The `composer dev` command starts the essential services required for development:
- **Logs**: Tail logs with `EnhancedTailCommand::file(storage_path('logs/laravel.log'))`.
- **Vite**: Runs `bun run dev` for frontend asset bundling.
- **HTTP**: Starts the development server with `php artisan serve`.
- **Queue**: Starts the queue worker with `php artisan queue:work`.
- **Reverb**: Starts the reverb process with `php artisan reverb:start --debug`.

All these services are executed concurrently with the **Solo** package by running the `composer dev` command, ensuring a streamlined development process without needing to run individual processes manually.

### Code Quality & Testing
- **Pint**: A Laravel-focused PHP code linter.
- **Rector**: A tool for refactoring PHP code.
- **Pest**: A testing framework for PHP, used for unit tests, coverage, and specific tests.
- **Peck**: For typo checking in the codebase.
- **PHPStan**: For static analysis to detect potential issues.

The following scripts help ensure that the code stays clean and error-free:
- **`composer fix`**: Runs Pint and Rector to fix code quality issues.
- **`composer test`**: Runs a suite of tests to ensure the application works as expected.
- **`composer fix:test`**: Runs both the fixup and tests in one script.

Here are some of the custom scripts included in the `composer.json` file:

```json
{
    "lint": "pint",
    "refactor": "rector",
    "fix": [
        "@refactor",
        "@lint"
    ],
    "fix:test": [
        "@fix",
        "@test:unit",
        "@test:typos",
        "@test:types",
        "@test:type-coverage"
    ],
    "test:lint": "pint --test",
    "test:refactor": "rector --dry-run",
    "test:translations": "@php artisan translations:check",
    "test:unit": "pest --parallel --coverage --exactly=100",
    "test:typos": "peck",
    "test:types": "phpstan",
    "test:type-coverage": "pest --type-coverage --min=100",
    "test:arch": "pest --filter=arch",
    "test": [
        "@test:lint",
        "@test:refactor",
        "@test:translations",
        "@test:unit",
        "@test:typos",
        "@test:types",
        "@test:type-coverage"
    ]
}
```

The whole test suite is executed as part of the auto-deploy process to ensure the application is stable before deploying to production.

### Setup
The `composer setup` script quickly sets up the Laravel basic configurations and installs necessary dependencies:
This script ensures that the necessary packages are installed and that the environment is ready for development or deployment.

### Deployment Workflow
- **Auto-deploy**: Once the tests pass and the code is committed to the `main` branch, the auto-deployment pipeline triggers and pushes the code to Laravel Cloud.

### Action Pattern / Command Pattern with Dependency Injection
This project leverages the **Action Pattern** (Command Pattern) extensively, using **Dependency Injection (DI)** to promote clean, scalable, and maintainable code.
The **Command Pattern** encapsulates actions as objects, decoupling the logic execution from the request. Each command is responsible for executing a specific task, and DI is used to inject necessary services, enhancing testability and flexibility.
The **FATLL stack** (Flux Pro, Alpine.js, TailwindCSS, Laravel, Livewire) integrates seamlessly with this pattern, allowing for clear separation of concerns and effective management of actions across the application. DI ensures all dependencies are automatically resolved, making it easy to manage complex workflows and actions.

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). As a derivative, **Action Starter Kit** is also licensed under the same [MIT license](https://opensource.org/licenses/MIT).

