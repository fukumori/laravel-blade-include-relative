# Laravel Blade Include Relative
Allows to include blade template with relative path based on current view.

## Installation

Require this package with composer.

```shell
composer require fukumori/laravel-blade-include-relative

```

### Clear view cache BEFORE usage
```shell
php artisan view:clear

```

## Usage

Make your view including sub-view with relative path
```php
<!-- Stored in resources/views/site/some-file.blade.php -->

{{-- full include with hint --}}
@include('site::partials.included-view', ['name' => 'site::partials.included-view'])
{{-- full include (normal usage) --}}
@include('site.partials.included-view', ['name' => 'site.partials.included-view'])
{{-- relative include --}}
@include('partials.included-view', ['name' => 'partials.included-view'])
{{-- relative includeIf --}}
@includeIf('partials.included-view', ['name' => 'if partials.included-view'])
{{-- relative includeWhen --}}
@includeWhen(true, 'partials.included-view', ['name' => 'when partials.included-view'])
{{-- relative each --}}
@each('partials.included-view', ['each1 partials.included-view', 'each2 partials.included-view'], 'name')
```

Make your sub-view
```php
<!-- Stored in resources/views/site/partials/included-view.blade.php -->

<div>Included view with: {{ $name ?? '' }}.</div>
```

Call your view
```php
<!-- Stored in routes/web.php -->

Route::view('/test', 'site.some-file');
```

See the magic appear
```html
<div>Included view with: site::partials.included-view.</div>
<div>Included view with: site.partials.included-view.</div>
<div>Included view with: partials.included-view.</div>
<div>Included view with: if partials.included-view.</div>
<div>Included view with: when partials.included-view.</div>
<div>Included view with: each1 partials.included-view.</div>
<div>Included view with: each2 partials.included-view.</div>
```
