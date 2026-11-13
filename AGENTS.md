<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

## Foundational Context

This application is a Laravel application running on PHP 8.5. Always use the APIs that match the installed major version of each package — do not assume a version.

Before relying on a package's API, confirm its installed version:
- PHP packages: run `composer show --direct` to list direct dependencies with versions, or `composer show <vendor/package>` for a single package.
- JS packages: check `package.json` for the installed versions.

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If a frontend change doesn't show in the UI or you get a "Unable to locate file in Vite manifest" error, run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Use `search-docs` before changes that depend on Laravel ecosystem APIs, behavior, configuration, or version-specific syntax. Skip it for copy-only edits and other changes where package documentation is irrelevant. Reuse sufficient results already in context instead of searching again.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Project Rules

- This project contains committed, area-grouped rules in `.ai/rules` when that directory exists, including path-scoped framework guidelines under `.ai/rules/boost`. Before you enter plan mode or create/edit any file, you MUST first: open @.ai/rules/index.md (it maps file globs to rule files), read every rule file whose globs cover the path(s) in scope, and run `grep -rin 'keyword' .ai/rules` to catch what a path match alone misses. Do not write code until you have read and are following every matching rule. If `.ai/rules` does not exist, continue without it.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.
- Activate the `deploying-to-cloud` skill whenever deploying to Laravel Cloud, configuring Cloud environments or resources, using the Cloud CLI, or troubleshooting Cloud deployments.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== phpunit/core rules ===

# PHPUnit

- This project uses PHPUnit. Create tests with `php artisan make:test --phpunit {name}`.
- Do not include the test suite directory in `{name}`. Use `SomeFeatureTest`, not `Feature/SomeFeatureTest`.
- Read the `testing-best-practices` skill for guidance on coverage, naming, structure, dependency isolation, and review.

## Running Tests

- Run the narrowest set of tests that covers the change. Pass a file path or `--filter=testName` to `php artisan test --compact`.
- Rerun a test after each change to it.
- Run `vendor/bin/phpunit` to call the test runner directly. It accepts the same file path and `--filter=testName` arguments.

</laravel-boost-guidelines>

<project-guidelines>
=== project context ===

# Alexandros Portfolio

- This is a single-page personal portfolio built with Laravel 13, Blade, Tailwind CSS 4, Vite, and vanilla JavaScript.
- Keep the application intentionally lightweight. Do not introduce a frontend framework, repository layer, service layer, or other abstraction unless the feature complexity clearly requires it and the user approves it.
- User-facing copy is written in Indonesian. Keep new copy natural, concise, and consistent with the existing tone.
- Preserve the current primary page sections and navigation flow unless a redesign is explicitly requested: Home, About, Skills, Projects, and Contact.

=== clean code ===

# Clean Code

- Optimize for readability and maintainability before cleverness or premature abstraction.
- Give classes, methods, variables, Blade components, and data attributes names that clearly communicate intent.
- Keep methods and JavaScript callbacks focused on one responsibility. Extract logic when a block has multiple responsibilities, is reused, or becomes difficult to understand.
- Prefer guard clauses to deeply nested conditionals.
- Remove dead code, unused imports, stale selectors, debug statements, and commented-out implementations.
- Do not duplicate business rules or content structures. Establish one clear source of truth and reuse it.
- Replace unexplained literals with named constants, configuration, theme tokens, or well-named variables when the value has domain meaning or is reused.
- Add comments only when they explain a non-obvious reason, constraint, or tradeoff. Do not narrate self-explanatory code.
- Keep changes small and cohesive. Avoid unrelated refactors while implementing a requested feature.
- Prefer the simplest Laravel-native solution that satisfies the requirement. Do not create an abstraction for a single trivial use case.

=== application architecture ===

# Application Architecture

- Keep routing declarations small. Put request handling in controllers and presentation in Blade views.
- Controllers coordinate a request; they should not accumulate large data definitions, complex validation, or reusable domain logic.
- Use a Form Request when validation or authorization becomes non-trivial, reused, or needs custom messages. Simple one-off validation may remain in the controller.
- Use Eloquent models for persisted domain data. Do not introduce persistence for static portfolio content unless content management is part of the requirement.
- Pass explicit, well-shaped data to views. Document array shapes with PHPDoc when structured arrays cross class or method boundaries.
- Extract Blade components or partials when markup is reused or a page section becomes difficult to scan. Do not fragment one-off, short markup without a readability benefit.
- Use named routes and Laravel URL helpers for internal navigation and form actions.

=== frontend and design ===

# Frontend & Design System

- Use a Mercedes-AMG PETRONAS Formula One-inspired visual direction: precision engineering, high performance, deep black/carbon surfaces, metallic silver structure, and a controlled PETRONAS turquoise accent. Take inspiration from the racing aesthetic without copying team logos, trademarks, sponsor layouts, or exact livery artwork.
- Use this working palette as the project source of truth:
  - `Carbon Black` `#050708` — primary page background.
  - `Obsidian` `#0B0F12` — navigation and elevated dark surfaces.
  - `Graphite` `#161B1F` — cards, borders, and secondary surfaces.
  - `Mercedes Silver` `#C8CDD0` — structural highlights, muted headings, and metallic details.
  - `Platinum White` `#F4F7F8` — primary text and high-contrast content.
  - `PETRONAS Turquoise` `#00D2BE` — primary brand accent, CTA, focus, active state, and selective glow.
  - `Deep Turquoise` `#009E91` — hover, pressed, and darker accent states.
- Aim for an approximate 70/20/10 color balance: 70% black and carbon, 20% graphite/silver/white, and no more than 10% turquoise. Turquoise is a precision accent, not a large-area background color.
- Prefer silver-to-black transitions, fine turquoise flow lines, subtle technical grids, aerodynamic diagonal cuts, and restrained star-like dot textures where they support hierarchy. Avoid excessive neon glow, generic cyberpunk styling, or visually noisy racing motifs.
- Use gradients sparingly. Approved directions are metallic silver to graphite and turquoise to deep turquoise; both should feel controlled and technical rather than decorative.
- Treat the tokens in `resources/css/app.css` under `@theme` as the source of truth for brand colors and typography. Extend tokens before scattering repeated arbitrary values.
- Reuse existing component classes such as `site-shell`, `primary-button`, `secondary-button`, `glass-card`, and form styles before adding new variants.
- Use Tailwind utilities for local layout and styling. Create a component class only for a repeated visual pattern or a meaningful design primitive.
- Keep responsive behavior intentional across mobile, tablet, and desktop. Do not treat the desktop layout as the only acceptance target.
- Maintain clear visual hierarchy, consistent spacing, and readable line lengths. New sections should feel native to the existing page rather than visually independent.
- Keep JavaScript framework-free unless the user approves a framework. Use progressive enhancement, null-safe DOM access, and small functions with explicit responsibilities.
- Keep behavior selectors based on `data-*` attributes; do not couple JavaScript behavior to styling classes.

=== accessibility and content ===

# Accessibility & Content Quality

- Use semantic HTML landmarks and native interactive elements before ARIA-based replacements.
- Every interactive element must be keyboard accessible and have a visible focus state.
- Maintain appropriate labels, alternative text, heading order, status/error announcements, and `aria-expanded` or `aria-pressed` states where applicable.
- Preserve `prefers-reduced-motion` support. Animations must not be required to understand or operate the page.
- Check foreground/background contrast when adding or changing colors, especially muted text and glass surfaces.
- External links that open a new tab must use `rel="noopener"` and make their destination understandable from the accessible name.
- Do not publish placeholder contact details, broken project links, or claims that have not been confirmed by the user.

=== security and privacy ===

# Security & Privacy

- Validate all server-side input even when the browser also validates it.
- Keep CSRF protection enabled for state-changing web requests and retain rate limiting on public forms.
- Do not log contact-form message bodies, email addresses, credentials, tokens, or other personally identifiable or secret data. Log only the minimum metadata needed for operations.
- Escape untrusted output through Blade's escaped syntax. Use raw output only for reviewed, trusted content with a clear reason.
- Keep secrets and environment-specific values in environment configuration; never commit them to source control.

=== testing and verification ===

# Testing & Quality Gates

- Add or update a test for every behavior change. Prefer feature tests for routes, form validation, rate limiting, responses, and rendered content; use unit tests for isolated logic.
- Cover the happy path, relevant validation failures, and important boundary cases. A test should describe observable behavior rather than implementation details.
- Run the narrowest relevant test during development, then run the full test suite when the change affects shared application behavior.
- When PHP files change, run `vendor/bin/pint --dirty --format agent` and the relevant PHPUnit tests.
- When frontend assets change, run `npm run build` and resolve build warnings or errors before finalizing.
- For user-interface changes, verify at representative mobile and desktop widths and check browser console errors, keyboard navigation, focus states, and reduced-motion behavior.

=== definition of done ===

# Definition of Done

A change is complete only when:

- The requested behavior works and matches existing project conventions.
- The implementation is readable, scoped, and free from known dead code or debug artifacts.
- Relevant automated tests pass.
- Formatting and frontend builds pass when applicable.
- Responsive layout, accessibility, security, and privacy implications have been considered.
- Documentation is updated only when behavior, setup, architecture, or project conventions changed.

</project-guidelines>
