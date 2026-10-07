/**
 * =========================================================================
 * Xynera Admin Dashboard - Vanilla JavaScript Logic
 * Handles Dual-Theme Engine state and Modal interactions natively.
 * =========================================================================
 */

document.addEventListener('DOMContentLoaded', () => {
    
    // ====================================================
    // 1. Dual-Theme Engine Logic
    // ====================================================
    
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    const themeIcon = document.getElementById('themeIcon');
    const htmlElement = document.documentElement; // Selected for [data-theme] mutation

    /**
     * Retrieves the saved theme from localStorage, 
     * or defaults to 'dark' for the Xynera branding baseline.
     */
    const getInitialTheme = () => {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            return savedTheme;
        }
        // Could check system pref here but default 'dark' as required by Xynera aesthetic
        return 'dark'; 
    };

    let currentTheme = getInitialTheme();

    /**
     * Applies the theme attribute to documentElement and 
     * switches the navigation toggle icon appropriately.
     * @param {string} theme - 'dark' or 'light'
     */
    const applyTheme = (theme) => {
        htmlElement.setAttribute('data-theme', theme);
        
        // Show the sun if we are dark to offer light mode, vice versa.
        themeIcon.textContent = theme === 'dark' ? 'light_mode' : 'dark_mode';
        
        // Persist preference
        localStorage.setItem('theme', theme);
    };

    // Initialize application with the correct theme
    applyTheme(currentTheme);

    // Event Listener for toggling
    themeToggleBtn.addEventListener('click', () => {
        currentTheme = currentTheme === 'dark' ? 'light' : 'dark';
        applyTheme(currentTheme);
    });


    // ====================================================
    // 2. New Project Upload Modal Logic
    // ====================================================
    
    // DOM Elements bindings
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    const projectModal = document.getElementById('projectModal');

    /**
     * Opens the modal by adding the state-driven utility class
     */
    const openModal = () => {
        if (!projectModal) return;
        projectModal.classList.add('active');
        const firstInput = projectModal.querySelector('input');
        if(firstInput) firstInput.focus();
    };

    /**
     * Closes the modal by removing the utility class.
     */
    const closeModal = () => {
        if (!projectModal) return;
        projectModal.classList.remove('active');
    };

    // Binding interaction events with safety checks
    if (openModalBtn && projectModal) openModalBtn.addEventListener('click', openModal);
    if (closeModalBtn && projectModal) closeModalBtn.addEventListener('click', closeModal);
    if (cancelModalBtn && projectModal) cancelModalBtn.addEventListener('click', closeModal);

    // Provide keyboard accessibility: Close modal when Escape key is pressed
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && projectModal && projectModal.classList.contains('active')) {
            closeModal();
        }
    });

    // Close the modal when clicking outside of the active form container content
    if (projectModal) {
        projectModal.addEventListener('click', (e) => {
            if (e.target === projectModal) {
                closeModal();
            }
        });
    }

});
