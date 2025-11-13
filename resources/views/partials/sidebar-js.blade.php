<script>
// Sidebar toggle functionality (guard DOM elements)
const headerMenu = document.getElementById('headerMenu');
const navToggle = document.getElementById('navToggle');
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');

function toggleSidebar() {
    if (!sidebar) return;
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    sidebar.classList.toggle('open');
    
    // Handle overlay for mobile
    if (sidebarOverlay) {
        if (sidebar.classList.contains('open')) {
            sidebarOverlay.classList.add('active');
        } else {
            sidebarOverlay.classList.remove('active');
        }
    }
    
    // Handle main content margin for desktop
    if (window.innerWidth > 768 && mainContent) {
        if (sidebar.classList.contains('open')) {
            mainContent.style.marginLeft = '280px';
        } else {
            mainContent.style.marginLeft = '0';
        }
    }
}

function initializeSidebar() {
    if (!sidebar) return;
    // Always start with sidebar closed
    sidebar.classList.remove('open');
    if (mainContent) {
        mainContent.style.marginLeft = '0';
    }
}

if (headerMenu) headerMenu.addEventListener('click', toggleSidebar);
if (navToggle) navToggle.addEventListener('click', toggleSidebar);

// Close sidebar on mobile when clicking outside
document.addEventListener('click', function (e) {
    if (!sidebar) return;
    if (window.innerWidth <= 768) {
        const clickedHeader = headerMenu && headerMenu.contains(e.target);
        if (!sidebar.contains(e.target) && !clickedHeader) {
            sidebar.classList.remove('open');
        }
    }
});

// Handle window resize - keep sidebar closed on resize
window.addEventListener('resize', function() {
    if (!sidebar) return;
    // On resize, close sidebar if it was open and adjust main content
    if (window.innerWidth <= 768) {
        sidebar.classList.remove('open');
        if (mainContent) mainContent.style.marginLeft = '0';
    } else {
        // On desktop, only adjust margin if sidebar is open
        if (sidebar.classList.contains('open') && mainContent) {
            mainContent.style.marginLeft = '280px';
        } else if (mainContent) {
            mainContent.style.marginLeft = '0';
        }
    }
});

// Initialize sidebar state on page load
initializeSidebar();
</script>