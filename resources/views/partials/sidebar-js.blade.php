<script>
// Unified Sidebar toggle behavior
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    if (!sidebar) {
        return;
    }

    const headerMenu = document.getElementById('headerMenu');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const toggleButtons = [headerMenu, sidebarToggle].filter(Boolean);
    const mainContent = document.getElementById('mainContent') || document.querySelector('.main-content');
    const navLinks = sidebar.querySelectorAll('.nav-menu a');

    function applyState(open) {
        if (open) {
            sidebar.classList.add('open');
            if (mainContent) {
                mainContent.classList.remove('sidebar-closed');
            }
        } else {
            sidebar.classList.remove('open');
            if (mainContent) {
                mainContent.classList.add('sidebar-closed');
            }
        }
    }

    // Start closed by default (especially after login)
    applyState(false);

    toggleButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            if (button.tagName === 'A') {
                event.preventDefault();
            }
            const isOpen = sidebar.classList.contains('open');
            applyState(!isOpen);
        });
    });

    navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            applyState(false);
        });
    });

    window.addEventListener('resize', function () {
        const isOpen = sidebar.classList.contains('open');
        applyState(isOpen);
    });
});
</script>
