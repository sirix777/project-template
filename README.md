## Project Template

Example service that should be used as a starting point for new projects.

This template uses PHP (≥ 8.4) and integrates several libraries and frameworks out of the box, including:
- Mezzio (PSR-15 middleware framework)
- Laminas (components for service management, configuration, etc.)
- Cycle ORM (for database interactions)
- Monolog (for logging)
- PHPUnit (for testing)
- Code quality tools (PHPStan, Rector, PHP-CS-Fixer, Deptrac)

The project is built on a modular architecture and consists of the following modules:
 - ApiGateway (handles API requests and routing)
 - Common (contains shared functionality)
 - ExampleModule (demonstrates module implementation)

The modules apply the principle of clean architecture, they are divided into layers: 
 - App (Application layer - contains use cases and application services)
 - Domain (Domain layer - contains business logic, entities, and domain services)
 - Infra (Infrastructure layer - contains implementations of repositories, external services, etc.)

### Getting Started

#### Requirements

- PHP 8.4 or higher
- Composer

#### Creating a New Project

Create a new project based on this template:
```bash
composer create-project sirix/project-template my-new-project-name --ignore-platform-reqs
```


### Available Commands

#### Development Mode

- Enable development mode:
```bash
composer development-enable
```

- Disable development mode:
```bash
composer development-disable
```

- Check development mode status:
```bash
composer development-status
```

#### Mezzio Commands

- Show all available Mezzio commands:
```bash
composer mezzio
# or
./vendor/bin/laminas
```

#### Database Commands

- Run database migrations:
```bash
./vendor/bin/laminas cycle:migrator:run
```

- Rollback database migrations:
```bash
./vendor/bin/laminas cycle:migrator:rollback
```

- Create a new migration:
```bash
./vendor/bin/laminas cycle:migrator:create PascalCaseMigrationName
```

- Create a new database seed:
```bash
./vendor/bin/laminas cycle:seed:create PascalCaseSeedName
```

- Run database seeds:
```bash
./vendor/bin/laminas cycle:seed
```

- Clear Cycle ORM cache:
```bash
./vendor/bin/laminas cycle:cache:clear
```

#### Code Quality Commands

- Run all code quality checks and tests:
```bash
composer check
```

- Check code style:
```bash
composer cs-check
```

- Fix code style:
```bash
composer cs-fix
```

- Run Rector (static analysis and automatic refactoring):
```bash
composer rector
```

- Run PHPStan (static analysis):
```bash
composer phpstan
```

- Run Deptrac to check layer dependencies:
```bash
composer deptrac-layers
```

- Run Deptrac to check module dependencies:
```bash
composer deptrac-modules
```

#### Testing Commands

- Run tests:
```bash
composer test
```

- Run tests with coverage report:
```bash
composer test-coverage
```

#### Server Commands

- Start development server:
```bash
composer serve
```

#### Utility Commands

- Clear config cache:
```bash
composer clear-config-cache
```

### Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

### License

This project is licensed under the MIT License - see the composer.json file for details.
