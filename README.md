## Project Template

Example service that should be used as a starting point for new projects.

This template uses PHP (≥ 8.4) and integrates several libraries and frameworks out of the box.

The example is built on a modular architecture and consists of the following modules:
 - ApiGateway
 - Common
 - ExampleModule


The modules apply the principle of clean architecture, they are divided into layers: 
 - Api
 - App
 - Domain
 - Infra

### How to create new project based on this template

1. Create a new project based on this template:
```bash
composer create-project sirix/project-template my-new-project-name --ignore-platform-reqs
```


#### Commands

- To show all available commands:
```bash
./vendor/bin/laminas
```

- Work with database:
```bash
./vendor/bin/laminas cycle:migrator:run
```
```bash
./vendor/bin/laminas cycle:migrator:rollback
```

```bash
./vendor/bin/laminas cycle:migrator:generate PascalCaseMigrationName
```

```bash
./vendor/bin/laminas cycle:cache:clear
```

- Check code style, static analysis, and run tests:
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
- Run static analysis:
```bash
composer rector
```
```bash
composer phpstan
```
```bash
composer deptrac-layers
```
```bash
command deptrac-modules
```
- Run tests:
```bash
composer test
```
