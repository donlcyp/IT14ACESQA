<script>
// Unified Sidebar toggle behavior - sidebar always hidden by default
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    
    if (!sidebar || !sidebarOverlay) {
        console.warn('Sidebar or overlay element not found');
        return;
    }

    const headerMenu = document.getElementById('headerMenu');
    const mainContent = document.getElementById('mainContent') || document.querySelector('.main-content');
    const navLinks = sidebar.querySelectorAll('.nav-menu a');

    function applyState(open) {
        if (open) {
            sidebar.classList.add('open');
            sidebarOverlay.classList.add('active');
            if (mainContent) {
                mainContent.classList.remove('sidebar-closed');
            }
        } else {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('active');
            if (mainContent) {
                mainContent.classList.add('sidebar-closed');
            }
        }
    }

    // Start closed by default
    applyState(false);

    // Only header menu button controls sidebar
    if (headerMenu) {
        headerMenu.addEventListener('click', function (event) {
            event.preventDefault();
            const isOpen = sidebar.classList.contains('open');
            applyState(!isOpen);
        });
    }

    // Close sidebar when clicking on overlay
    sidebarOverlay.addEventListener('click', function (e) {
        e.stopPropagation();
        applyState(false);
    });

    // Close sidebar when clicking nav links
    navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            applyState(false);
        });
    });

    // Maintain state on window resize
    window.addEventListener('resize', function () {
        const isOpen = sidebar.classList.contains('open');
        applyState(isOpen);
    });
});
</script>
