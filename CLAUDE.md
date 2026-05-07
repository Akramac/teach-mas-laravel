# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**teach-mas** is a Laravel 9 exam management platform with two primary roles: Teacher and Student. Teachers create and correct exams with multiple question types; Students take assigned exams and view results.

## Development Commands

```bash
# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate
php artisan db:seed

# Start servers (run both concurrently)
php artisan serve        # Backend at http://127.0.0.1:8000
npm run dev              # Vite asset watcher

# Production build
npm run build

# Testing
php artisan test
php vendor/bin/phpunit

# Utilities
php artisan tinker       # REPL
php artisan migrate:rollback
```

## Architecture

### Routing (`routes/web.php`)

Routes are split into two authenticated groups:
- `/teacher/*` — exam creation, correction, affectation, results
- `/student/*` — exam taking, viewing results

Authentication routes: `/login`, `/register`, `/logout`

### Controllers

`TeacherController` (~2000 lines) and `StudentController` (~1000 lines) handle the bulk of business logic. Each method maps to a specific exam workflow step (create, add questions, correct, view results).

### Models

26 Eloquent models organized around the exam domain:

**Users:** `User`, `Teacher` (has `approved_by_admin`), `Student`

**Exams:** `Exam` (settings: duration, recording, randomization, `no_remake_exam`, `show_results`), `Categorie`, `HashUrlExam`

**Question Types (5):** `LongText`, `MultiChoice`, `Span`, `Tartib` (ordering), `Tawsil` (matching)

**Response Types (5):** `ResponseQuestionLongText`, `ResponseQuestionMultiChoice`, `ResponseQuestionSpan`, `ResponseQuestionTartib`, `ResponseQuestionTawsil`

**Junction Tables:** `StudentExam`, `StudentTeacher`, `ExamTeacher`, plus per-type exam-question pivot tables

### Views

Blade templates in `resources/views/` organized by role:
- `teacher/` — exam management, correction, affectation
- `student/` — exam taking, results
- `security/` — login/register
- `partials/` — shared layout components

### Database

MySQL, configured in `.env`:
```
DB_DATABASE=teach-mas
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USERNAME=root
DB_PASSWORD=
```

32 migrations define the schema. Each question type has its own table and corresponding response table.

### Frontend

Vite bundles assets from `resources/js/` and `resources/css/`. Axios is used for AJAX requests within Blade templates.

## Key Constraints

- The `.env` file is protected — Claude Code is configured to deny Read/Write/Bash access to it.
- Teacher accounts require admin approval (`teachers.approved_by_admin` flag).
- Exams support per-question-type relationships — adding a new question type requires: a model, migration, controller methods (teacher create/correct + student respond), and view partials.
- `no_remake_exam` flag on `Exam` prevents students from retaking; check this before allowing exam submission.
