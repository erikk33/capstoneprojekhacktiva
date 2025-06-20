<!-- resources/views/components/darkmodeadmin.blade.php -->
<div class="dark-mode-toggle">
    <button class="toggle-button">
        <i class="fas fa-moon"></i>
    </button>
    <div class="dark-mode-popup">
        <div class="popup-header">
            <h4>Pengaturan Tampilan</h4>
            <i class="fas fa-times close-popup"></i>
        </div>
        <div class="popup-body">
            <div class="theme-option">
                <button class="theme-btn light-mode-btn">
                    <i class="fas fa-sun"></i>
                    <span>Light Mode</span>
                </button>
                <button class="theme-btn dark-mode-btn">
                    <i class="fas fa-moon"></i>
                    <span>Dark Mode</span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .dark-mode-toggle {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 999;
    }

    .toggle-button {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .toggle-button:hover {
        transform: scale(1.1);
        background: var(--secondary);
    }

    .dark-mode-popup {
        position: absolute;
        bottom: 60px;
        right: 0;
        width: 250px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        padding: 15px;
        display: none;
        z-index: 1000;
    }

    .dark-mode-popup.show {
        display: block;
    }

    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .popup-header h4 {
        margin: 0;
        font-size: 1rem;
        color: var(--dark);
    }

    .popup-header .close-popup {
        cursor: pointer;
        color: var(--gray);
    }

    .popup-header .close-popup:hover {
        color: var(--dark);
    }

    .theme-option {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .theme-btn {
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #eee;
        background: #f9f9f9;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .theme-btn:hover {
        background: #f0f0f0;
    }

    .theme-btn.active {
        border-color: var(--primary);
        background: rgba(67, 97, 238, 0.1);
    }

    .theme-btn span {
        font-size: 0.9rem;
        color: var(--dark);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.querySelector('.dark-mode-toggle .toggle-button');
        const popup = document.querySelector('.dark-mode-popup');
        const closePopup = document.querySelector('.close-popup');
        const lightModeBtn = document.querySelector('.light-mode-btn');
        const darkModeBtn = document.querySelector('.dark-mode-btn');

        // Toggle popup
        toggleButton.addEventListener('click', function(e) {
            e.stopPropagation();
            popup.classList.toggle('show');
        });

        // Close popup when click outside
        document.addEventListener('click', function(e) {
            if (!popup.contains(e.target) && !toggleButton.contains(e.target)) {
                popup.classList.remove('show');
            }
        });

        // Close popup when click close button
        closePopup.addEventListener('click', function() {
            popup.classList.remove('show');
        });

        // Set theme
        function setTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark-mode');
                darkModeBtn.classList.add('active');
                lightModeBtn.classList.remove('active');
            } else {
                document.documentElement.classList.remove('dark-mode');
                lightModeBtn.classList.add('active');
                darkModeBtn.classList.remove('active');
            }
            localStorage.setItem('theme', theme);
        }

        // Check saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            setTheme(savedTheme);
        } else {
            // Default to light
            setTheme('light');
        }

        // Light mode button
        lightModeBtn.addEventListener('click', function() {
            setTheme('light');
        });

        // Dark mode button
        darkModeBtn.addEventListener('click', function() {
            setTheme('dark');
        });
    });
</script>