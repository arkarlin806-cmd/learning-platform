import './bootstrap';

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





