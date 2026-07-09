const CACHE_NAME = 'notes-pwa-v1';
const URLS_TO_CACHE = ['/', '/offline'];

self.addEventListener('install', event => {
  event.waitUntil(
   caches.open(CACHE_NAME).then(cache => cache.addAll(URLS_TO_CACHE))
  );
  self.skipWaiting();
});

self.addEventListener('activate', event => {
  event.waitUntil(
   caches.keys().then(keys =>
      Promise.all(keys.filter(k => k !== CACHE_NAME).map(k => caches.delete(k)))
   )
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
   fetch(event.request).catch(() => caches.match('/offline'))
  );
});