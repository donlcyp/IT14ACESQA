// Close sidebar on mobile when clicking outside
// Handle window resize
// Initialize sidebar state on page load
<script>
// Sidebar toggle functionality (guard DOM elements)
const headerMenu = document.getElementById('headerMenu');
const navToggle = document.getElementById('navToggle');
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');

function toggleSidebar() {
    if (!sidebar) return;
    sidebar.classList.toggle('open');
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
    if (window.innerWidth > 768 && mainContent) {
        sidebar.classList.add('open');
        mainContent.style.marginLeft = '280px';
    } else {
        sidebar.classList.remove('open');
        if (mainContent) mainContent.style.marginLeft = '0';
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

// Handle window resize
window.addEventListener('resize', initializeSidebar);

// Initialize sidebar state on page load
initializeSidebar();
</script>