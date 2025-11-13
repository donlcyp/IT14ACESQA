<script>
// Unified Sidebar toggle
(function() {
    const headerMenu = document.getElementById('headerMenu');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const mainContent = document.getElementById('mainContent') || document.querySelector('.main-content');
    const STORAGE_KEY = 'sidebarOpen';

    function applyState(open, persist = false) {
        const isMobile = window.innerWidth <= 768;
        if (!sidebar) return;
        if (open) {
            sidebar.classList.add('open');
            if (!isMobile) {
                if (mainContent) mainContent.classList.remove('sidebar-closed');
                if (sidebarOverlay) sidebarOverlay.classList.remove('active');
            } else {
                if (sidebarOverlay) sidebarOverlay.classList.add('active');
            }
        } else {
            sidebar.classList.remove('open');
            if (mainContent) mainContent.classList.add('sidebar-closed');
            if (sidebarOverlay) sidebarOverlay.classList.remove('active');
        }
        if (persist) {
            try { localStorage.setItem(STORAGE_KEY, open ? '1' : '0'); } catch (e) {}
        }
    }

    // Initial state: use saved value if available; else open on desktop, closed on mobile
    let saved = null;
    try { saved = localStorage.getItem(STORAGE_KEY); } catch (e) { saved = null; }
    const initialOpen = saved !== null ? saved === '1' : (window.innerWidth > 768);
    applyState(initialOpen, false);

    if (headerMenu) {
        headerMenu.addEventListener('click', function(){
            const next = !sidebar.classList.contains('open');
            applyState(next, true);
        });
    }

    // Close overlay on mobile when clicking outside
    document.addEventListener('click', function (e) {
        if (!sidebar) return;
        if (window.innerWidth <= 768) {
            const clickedHeader = headerMenu && headerMenu.contains(e.target);
            if (!sidebar.contains(e.target) && !clickedHeader) {
                applyState(false, true);
            }
        }
    });

    window.addEventListener('resize', function(){
        // Re-apply to adjust classes correctly per breakpoint, honor saved preference on desktop
        let saved = null;
        try { saved = localStorage.getItem(STORAGE_KEY); } catch (e) { saved = null; }
        const preferred = saved !== null ? saved === '1' : (window.innerWidth > 768);
        const effectiveOpen = window.innerWidth > 768 ? preferred : (sidebar && sidebar.classList.contains('open'));
        applyState(effectiveOpen, false);
    });
})();
</script>