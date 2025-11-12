<!-- === JS Dependencies (Bootstrap 5, Iconify, jsPDF) === -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

<!-- flatpickr for smooth datepicker (used in reminder modals) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

{{-- JS --}}
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/reminder.js') }}"></script>
<script src="{{ asset('js/history.js') }}"></script>

{{-- Favicon fallback: ensure favicon is present and refreshed on page load / navigation.
Some browsers/conditions can drop the favicon when query strings change or during
history navigation — set it explicitly here using optimized small favicon files. --}}
<script>
    (function () {
        try {
            function replaceFavicons() {
                // remove any existing favicon-like links
                var links = document.querySelectorAll('link[rel*="icon"], link[rel="apple-touch-icon"]');
                links.forEach(function (l) { try { l.parentNode.removeChild(l); } catch (e) { } });

                // create a small set of favicons (32x32,16x16, fallback ico)
                function addLink(rel, href, type, sizes) {
                    try {
                        var el = document.createElement('link');
                        el.rel = rel;
                        if (type) el.type = type;
                        if (sizes) el.sizes = sizes;
                        el.href = href;
                        document.head.appendChild(el);
                    } catch (e) {
                        console && console.debug && console.debug('addLink failed', rel, href, e);
                    }
                }

                // small icons (prefer these for fast load and consistent browser behavior)
                addLink('icon', '{{ asset('images/icon/garuda-32.png') }}', 'image/png', '32x32');
                addLink('icon', '{{ asset('images/icon/garuda-16.png') }}', 'image/png', '16x16');
                addLink('shortcut icon', '{{ asset('images/icon/favicon.ico') }}');
            }

            // Set on load immediately
            if (document.readyState === 'complete' || document.readyState === 'interactive') {
                replaceFavicons();
                console && console.debug && console.debug('favicon replace applied');
            } else {
                window.addEventListener('DOMContentLoaded', function () {
                    replaceFavicons();
                    console && console.debug && console.debug('favicon replace applied (DOMContentLoaded)');
                });
            }

            // Also re-apply on history navigation/popstate (back/forward)
            window.addEventListener('popstate', replaceFavicons);

            // And when the page becomes visible again (covers some tab-switch cache cases)
            document.addEventListener('visibilitychange', function () {
                if (document.visibilityState === 'visible') replaceFavicons();
            });
        } catch (e) {
            // swallowing errors to avoid breaking other page JS
            console && console.debug && console.debug('favicon fallback failed', e);
        }
    })();
</script>

</body>

</html>