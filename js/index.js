const body = document.querySelector("body");
const toggleThemeBtn = document.querySelector("#toggle_theme");
const logo = document.querySelector("#logo");

function applyTheme(theme) {
    if (theme === "dark") {
        body.classList.add("dark");
        logo.src = "img/light_logo.png";
    } else {
        body.classList.remove("dark");
        logo.src = "img/dark_logo.png";
    }
}

toggleThemeBtn.addEventListener("click", () => {
    const isDark = body.classList.toggle("dark");

    const theme = isDark ? "dark" : "light";
    localStorage.setItem("theme", theme);

    applyTheme(theme);
});

const savedTheme = localStorage.getItem("theme") || "dark";
applyTheme(savedTheme);

const removeNotificationBtn = document.querySelector("#remove_notification");

removeNotificationBtn.addEventListener("click", (e) => {
    let notification = e.target.closest(".notification");

    if(notification){
        notification.classList.add("closing");

        setTimeout(() => {
            notification.remove();
        }, 300);
    };
});