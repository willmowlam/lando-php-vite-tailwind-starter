<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Project</title>

  <?php
  function getAssetPath($asset)
  {
    $distPath = 'dist/';

    $manifestPath = __DIR__ . '/' . $distPath . 'manifest.json';
    if (!file_exists($manifestPath)) {
      throw new Exception('Manifest file not found at path: ' . $manifestPath . ' Please run the build process.');
    }

    $manifest = json_decode(file_get_contents($manifestPath), true);

    if (!isset($manifest['main.js'])) {
      throw new Exception("Asset not found in manifest: $asset");
    }

    if ($asset === 'main.js') {
      return $distPath . $manifest['main.js']['file'];
    }

    if ($asset === 'main.css' && isset($manifest['main.js']['css'][0])) {
      return $distPath . $manifest['main.js']['css'][0];
    }

    throw new Exception("Asset not found in manifest: $asset");
  }

  $appEnv = getenv('APP_ENV') ?? 'unknown';
  $isDev = $appEnv === 'development';

  if ($isDev) {
    $jsPath = "http://localhost:5173/main.js";
    $cssPath = null; // No separate CSS path in development as it's handled by JS
  } else {
    try {
      $jsPath = getAssetPath('main.js');
      $cssPath = getAssetPath('main.css');
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
  ?>

  <?php if ($isDev) : ?>
    <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="<?= $jsPath ?>"></script>
  <?php else : ?>
    <link rel="stylesheet" href="<?= $cssPath ?>">
    <script type="module" src="<?= $jsPath ?>"></script>
  <?php endif; ?>

</head>

<body>
  <h1 class="text-[26px]">Lando PHP Vite Tailwind Starter</h1>
  <p class="text-red-600">APP_ENV: <strong>'<?php echo $appEnv; ?>'</strong></p>
</body>

</html>