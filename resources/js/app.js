import './bootstrap';
import '../css/app.css';
        //theme
        document.addEventListener("DOMContentLoaded", () => {

            const html = document.documentElement;
            const button = document.getElementById("themeToggle");
        
            // Load Theme
            if (localStorage.getItem("theme") === "dark") {
                html.classList.add("dark");
        
                if (button) {
                    button.innerHTML = "☀️";
                }
            }
        
            if (button) {
        
                button.addEventListener("click", () => {
        
                    html.classList.toggle("dark");
        
                    if (html.classList.contains("dark")) {
        
                        localStorage.setItem("theme", "dark");
                        button.innerHTML = "☀️";
        
                    } else {
        
                        localStorage.setItem("theme", "light");
                        button.innerHTML = "🌙";
        
                    }
        
                });
        
            }
        
        });

//language
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');

document.getElementById('openSidebar')
    .addEventListener('click', () => {

        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');

    });

document.getElementById('closeSidebar')
    .addEventListener('click', closeSidebar);

overlay.addEventListener('click', closeSidebar);

function closeSidebar() {

    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');

}

const profileBtn = document.getElementById('profileBtn');
const profileMenu = document.getElementById('profileMenu');

profileBtn.addEventListener('click', () => {

    profileMenu.classList.toggle('hidden');

});

const collapseBtn = document.getElementById('collapseBtn');

collapseBtn.addEventListener('click', () => {

    sidebar.classList.toggle('w-72');
    sidebar.classList.toggle('w-24');

    document.querySelectorAll('.menu-text')
        .forEach(el => el.classList.toggle('hidden'));

    document.getElementById('logoText')
        .classList.toggle('hidden');

});




