(function () {
  if (!("serviceWorker" in navigator)) return;

  let refreshing = false;

  window.addEventListener("load", function () {
    navigator.serviceWorker
      .register("/sw.js", { scope: "/" })
      .then((reg) => {
        console.log("[SW] PWA Registered. Scope:", reg.scope);

        if (reg.waiting) {
          reg.waiting.postMessage("SKIP_WAITING");
        }

        reg.addEventListener("updatefound", () => {
          const newWorker = reg.installing;
          if (!newWorker) return;

          newWorker.addEventListener("statechange", () => {
            if (
              newWorker.state === "installed" &&
              navigator.serviceWorker.controller
            ) {
              console.log("[SW] New update available!");
              newWorker.postMessage("SKIP_WAITING");
            }
          });
        });
      })
      .catch((err) => console.error("[SW] Fail:", err));
  });

  navigator.serviceWorker.addEventListener("controllerchange", () => {
    if (refreshing) return;
    refreshing = true;
    window.location.reload();
  });
})();
