# Lando PHP Vite Tailwind Starter

This sets up an integration of Lando for PHP development with Vite as the frontend tool for Tailwind.

## Instructions

1. On your local development environment, create a .env file in the root directory with the contents:

`APP_ENV=development`

2. If required, customize where your production assets should be.

In vite.config.js

```
  build: {
    outDir: "../dist",
  }
```

and your index.php

```
  $distPath = 'dist/';`
```

3. Start Lando

`lando start`

4. Start Vite

`vite`
