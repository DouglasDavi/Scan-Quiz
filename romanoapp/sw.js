var cacheName = 'QuizApp';
var filesToCache = [
    './',
    './index.php',
    './view.php',
    './cabecalho.php',
    './data.php',
    './funcoes.php',
    './login.php',
    './perguntas.php',
    './quiz.php',
    './minhaClassificacao.php',
    './minhasPerguntas.php',
    './rodape.php',
    './topo.php',
    './tabelaClassificacao.php',
    './assets/android-icon-36x36.php',
    './assets/android-icon-48x48php',
    './assets/android-icon-72x72.php',
    './assets/android-icon-96x96.php',
    './assets/android-icon-144x144.php',
    './assets/android-icon-192x192.php',
    './assets/android-icon-256x256.php',
    './assets/android-icon-512x512.php',
    './assets/apple-icon-57x57.php',
    './assets/apple-icon-60x60php',
    './assets/apple-icon-72x72.php',
    './assets/apple-icon-114x144.php',
    './assets/apple-icon-120x120.php',
    './assets/apple-icon-144x144.php',
    './assets/apple-icon-152x152.php',
    './assets/apple-icon-180x180.php',
    './assets/manifest.json'
];
self.addEventListener('install', function(e) {
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      return cache.addAll(filesToCache);
    })
  );
});
self.addEventListener('fetch', function(e) {
  e.respondWith(
    caches.match(e.request).then(function(response) {
      return response || fetch(e.request);
    })
  );
});