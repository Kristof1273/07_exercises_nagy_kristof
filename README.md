
## Running the Application (Testing)

## Getting Started (Docker Setup)

Before running any commands, you must ensure that your Docker containers are up and running. 

**Start the environment (in detached mode):**
```bash
docker compose up -d
```

To test the output and behavior of all exercises (Exercise 01-03) together, execute the main entry point via the Docker container:
```bash
docker compose exec app php index.php
```
## Code Quality and Static Analysis (Tools)

The project ensures code formatting using **PHP-CS-Fixer** and type safety/bug detection using **PHPStan** (Level 6). These tools are easily accessible via Composer scripts defined in the project.

### 1. Code Formatting (PHP-CS-Fixer)

**Check (Dry-run):**
Displays what the formatter would change in the codebase (based on the PSR-12 standard) without actually modifying the files.
```bash
docker compose exec app composer lint
```

**Auto-fix (Format):**
Executes the formatter and automatically fixes any styling violations in the files.
```bash
docker compose exec app composer format
```

### 2. Static Code Analysis (PHPStan)

Runs strict type checking and error detection on the codebase without executing it. Ensures enterprise-level code stability.
```bash
docker compose exec app composer analyse
```

### 3. Unit Testing (PHPUnit)

Executes the automated test suite with a detailed output format.
```bash
docker compose exec app composer test
```
