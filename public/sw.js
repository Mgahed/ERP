//install process
self.addEventListener("install", event => {
    console.log('SW is Installed');
});

//activate process
self.addEventListener('activate', event => {
    console.log('SW is Activated');
    return self.clients.claim();
});

// Serve from Cache
self.addEventListener("fetch", event => {
    /*console.log('SW fetch event ', event);*/
    event.respondWith(fetch(event.request));
});
