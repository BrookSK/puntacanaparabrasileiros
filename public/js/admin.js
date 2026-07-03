/**
 * Admin Panel JavaScript
 */
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle (mobile)
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('adminSidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }

    // Auto-hide alerts after 5s
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // Config tabs - remember last tab
    const configTabs = document.getElementById('configTabs');
    if (configTabs) {
        const activeTab = localStorage.getItem('activeConfigTab');
        if (activeTab) {
            const tab = configTabs.querySelector(`a[href="${activeTab}"]`);
            if (tab) {
                const bsTab = new bootstrap.Tab(tab);
                bsTab.show();
            }
        }

        configTabs.querySelectorAll('a').forEach(tab => {
            tab.addEventListener('shown.bs.tab', function(e) {
                localStorage.setItem('activeConfigTab', e.target.getAttribute('href'));
            });
        });
    }
});
