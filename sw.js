const VERSION = "v1.0.8-php";
const STATIC_CACHE = `static-${VERSION}`;
const RUNTIME_CACHE = `runtime-${VERSION}`;
const PRECACHE_URLS = [
  "./",
  "index.php",
  "nilai_ijazah.php",
  "assets/css/style.css",
  "assets/js/script.js",
  "site.webmanifest",
  "assets/img/favicon-32.png",
  "assets/img/logo-192.png",
  "assets/img/logo-512.png",
  "assets/img/permata-min.png",
  "assets/img/icons/icon-192.png",
  "assets/img/icons/icon-512.png",
];

self.addEventListener("install", (event) => {
  event.waitUntil(
    (async () => {
      const cache = await caches.open(STATIC_CACHE);
      await Promise.all(
        PRECACHE_URLS.map((url) =>
          cache.add(url).catch((err) => console.warn("[SW] Gagal cache:", url))
        )
      );
      await self.skipWaiting();
    })()
  );
});

self.addEventListener("activate", (event) => {
  event.waitUntil(
    (async () => {
      if ("navigationPreload" in self.registration) {
        try {
          await self.registration.navigationPreload.enable();
        } catch {}
      }
      const keys = await caches.keys();
      await Promise.all(
        keys.map((k) => {
          if (![STATIC_CACHE, RUNTIME_CACHE].includes(k))
            return caches.delete(k);
        })
      );
      await self.clients.claim();
    })()
  );
});

self.addEventListener("fetch", (event) => {
  const req = event.request;
  if (req.method !== "GET") return;

  const url = new URL(req.url);
  if (url.pathname.includes("/admin/")) {
    return;
  }

  if (req.mode === "navigate") {
    event.respondWith(handleNavigation(event));
    return;
  }

  if (url.origin === self.location.origin) {
    if (url.pathname.startsWith("/assets/")) {
      event.respondWith(cacheFirst(req, RUNTIME_CACHE));
      return;
    }
  }

  const isCdn =
    /(cdn\.jsdelivr\.net|unpkg\.com|cdnjs\.cloudflare\.com|fonts\.googleapis\.com|fonts\.gstatic\.com)$/i.test(
      url.hostname
    );
  if (isCdn) {
    event.respondWith(staleWhileRevalidate(req, RUNTIME_CACHE));
    return;
  }

  event.respondWith(networkFirst(req, RUNTIME_CACHE));
});

async function handleNavigation(event) {
  try {
    const preload = await event.preloadResponse;
    if (preload) return preload;

    const net = await fetch(event.request);
    if (net && net.ok) {
      const cache = await caches.open(RUNTIME_CACHE);
      cache.put(event.request, net.clone());
      return net;
    }
  } catch (e) {
    const cache = await caches.open(STATIC_CACHE);
    const cached = await cache.match(event.request);
    return cached || (await cache.match("index.php"));
  }
}

async function cacheFirst(req, cacheName) {
  const cache = await caches.open(cacheName);
  const cached = await cache.match(req);
  if (cached) return cached;
  try {
    const resp = await fetch(req);
    if (resp && resp.ok) cache.put(req, resp.clone());
    return resp;
  } catch {
    return new Response("", { status: 404, statusText: "Not Found" });
  }
}

async function staleWhileRevalidate(req, cacheName) {
  const cache = await caches.open(cacheName);
  const cached = await cache.match(req);
  const fetching = fetch(req)
    .then((resp) => {
      if (resp && resp.ok) cache.put(req, resp.clone());
      return resp;
    })
    .catch(() => cached);
  return cached || fetching;
}

async function networkFirst(req, cacheName) {
  const cache = await caches.open(cacheName);
  try {
    const resp = await fetch(req);
    if (resp && resp.ok) cache.put(req, resp.clone());
    return resp;
  } catch {
    return await cache.match(req);
  }
}

self.addEventListener("message", (evt) => {
  if (evt.data === "SKIP_WAITING") self.skipWaiting();
});
