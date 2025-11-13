<script>
// Unified Sidebar toggle
document.addEventListener('DOMContentLoaded', function() {
    const headerMenu = document.getElementById('headerMenu');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent') || document.querySelector('.main-content');
    const STORAGE_KEY = 'sidebarOpen';

    if (!sidebar) {
        console.warn('Sidebar element not found');
        return;
    }

    function applyState(open, persist = false) {
        if (open) {
            sidebar.classList.add('open');
            if (mainContent) mainContent.classList.remove('sidebar-closed');
        } else {
            sidebar.classList.remove('open');
            if (mainContent) mainContent.classList.add('sidebar-closed');
        }
        if (persist) {
            try { localStorage.setItem(STORAGE_KEY, open ? '1' : '0'); } catch (e) {}
        }
    }

    // Initial state: restore from storage; default to open on desktop-only app
    let open = true;
    try {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved === '0') open = false;
        if (saved === '1') open = true;
    } catch (e) {}
    applyState(open, false);

    // Toggle sidebar on button click
    if (headerMenu) {
        headerMenu.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const next = !sidebar.classList.contains('open');
            applyState(next, true);
        });
    } else {
        console.warn('Header menu button (headerMenu) not found');
    }

    // Close sidebar when navigation links are clicked
    const navItems = sidebar.querySelectorAll('.nav-item');
    navItems.forEach(function(navItem) {
        navItem.addEventListener('click', function() {
            // Close sidebar after navigation click
            applyState(false, true);
        });
    });

    window.addEventListener('resize', function(){
        // Maintain current state when resizing, just re-apply to adjust classes correctly per breakpoint
        if (!sidebar) return;
        const isCurrentlyOpen = sidebar.classList.contains('open');
        applyState(isCurrentlyOpen, false);
    });
});
</script>