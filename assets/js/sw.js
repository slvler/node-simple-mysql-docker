/**======================================
*    EGEGEN
*    https://www.egegen.com   
*    
*    @Company       : Mopsan
*    @Created on    : 03.Eylül.2019
*    @Author        : Ergun C.
*    @Version       : 0.0.0
*    @Description   : İnternet bağlantısı kesildiğinde yüklenen sayfanın görüntülenmesi için sayfayı ön bellege alır.
*******************************************/

const PRECACHE = 'precache-v1';
const RUNTIME = 'runtime';

/* Ön bellegele alınacak dosya ve sayfalar burada belirtilir. 
 * html,css,font,js ve diğer uzantılı dosyalar eklenebilir. 
 * */
const PRECACHE_URLS = [
          './',
          './../css/layout.css',
          './../css/utilities.css',
          './../css/custom.css',
          './main.js'
        ];


self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(PRECACHE)
      .then(cache => cache.addAll(PRECACHE_URLS))
      .then(self.skipWaiting())
  );
});

self.addEventListener('activate', event => {
  const currentCaches = [PRECACHE, RUNTIME];
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return cacheNames.filter(cacheName => !currentCaches.includes(cacheName));
    }).then(cachesToDelete => {
      return Promise.all(cachesToDelete.map(cacheToDelete => {
        return caches.delete(cacheToDelete);
      }));
    }).then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', event => {
  // Skip cross-origin requests, like those for Google Analytics.
  if (event.request.url.startsWith(self.location.origin)) {
    event.respondWith(
      caches.match(event.request).then(cachedResponse => {
        if (cachedResponse) {
          return cachedResponse;
        }
        return caches.open(RUNTIME).then(cache => {
          return fetch(event.request).then(response => {
            // Put a copy of the response in the runtime cache.
            return cache.put(event.request, response.clone()).then(() => {
              return response;
            });
          });
        });
      })
    );
  }
});