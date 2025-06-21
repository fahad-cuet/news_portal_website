document.addEventListener("DOMContentLoaded", () => {
  // ===== Date Handling =====
  const dateSpan = document.getElementById("current-date");
  if (dateSpan) {
    const today = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    dateSpan.textContent = ` ${today.toLocaleDateString(undefined, options)}`;
  }

  // ===== Weather Info (Using Geolocation + OpenWeather API) =====
  const locationSpan = document.getElementById("location");
  const temperatureSpan = document.getElementById("temperature");

  if (locationSpan && temperatureSpan) {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const lat = position.coords.latitude;
          const lon = position.coords.longitude;

          const apiKey = "8aa251adc6411d887780837a0cbd78e0"; // Keep this safe in production!
          const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&appid=${apiKey}`;

          fetch(url)
            .then(response => response.json())
            .then(data => {
              const city = data.name;
              const temp = Math.round(data.main.temp);
              locationSpan.textContent = ` ${city}`;
              temperatureSpan.textContent = ` ${temp}°C`;
            })
            .catch(() => {
              temperatureSpan.textContent = " Temp: N/A";
              locationSpan.textContent = " Location: N/A";
            });
        },
        () => {
          locationSpan.textContent = "📍 Location blocked";
          temperatureSpan.textContent = "🌡 Temp: N/A";
        }
      );
    } else {
      locationSpan.textContent = "📍 Location unsupported";
      temperatureSpan.textContent = "🌡 Temp: N/A";
    }
  }

  // ===== Hamburger & Side Menu Logic =====
  const hamburger = document.getElementById("hamburger");
  const sideOverlay = document.getElementById("side-overlay");
  const sideMenu = document.getElementById("side-menu");
  const closeBtn = document.getElementById("close-btn");

  if (hamburger && sideOverlay && sideMenu && closeBtn) {
    hamburger.addEventListener("click", () => {
      sideOverlay.classList.add("active");
      sideMenu.classList.add("active");
    });

    closeBtn.addEventListener("click", () => {
      sideOverlay.classList.remove("active");
      sideMenu.classList.remove("active");
    });

    sideOverlay.addEventListener("click", (e) => {
      if (!sideMenu.contains(e.target)) {
        sideOverlay.classList.remove("active");
        sideMenu.classList.remove("active");
      }
    });
  }

  // ===== Dropdown Toggles inside Sidebar =====
  document.querySelectorAll(".dropdown-toggle").forEach(toggle => {
    toggle.addEventListener("click", () => {
      const dropdown = toggle.nextElementSibling;
      if (dropdown) {
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
      }
    });
  });

  document.querySelectorAll(".sub-toggle").forEach(toggle => {
    toggle.addEventListener("click", () => {
      const sub = toggle.nextElementSibling;
      if (sub) {
        sub.style.display = sub.style.display === "block" ? "none" : "block";
      }
    });
  });

  // ===== Optional Category Buttons (if you use them later) =====
  const GeneralBtn = document.getElementById("General");
  const InternationalBtn = document.getElementById("International");
  const SportsBtn = document.getElementById("Sport");
  const EntertainmentBtn = document.getElementById("Entertainment");
  const technologyBtn = document.getElementById("technology");
  const searchBtn = document.getElementById("searchBtn");

  // These are placeholders in case you want to wire them up later
  
  // Toggle modals
const loginModal = document.getElementById("login-modal");
const registerModal = document.getElementById("register-modal");

document.querySelector(".login-btn").addEventListener("click", () => {
  loginModal.style.display = "flex";
});

document.getElementById("login-close").onclick = () => {
  loginModal.style.display = "none";
};
document.getElementById("register-close").onclick = () => {
  registerModal.style.display = "none";
};

document.getElementById("show-register").onclick = (e) => {
  e.preventDefault();
  loginModal.style.display = "none";
  registerModal.style.display = "flex";
};
document.getElementById("show-login").onclick = (e) => {
  e.preventDefault();
  registerModal.style.display = "none";
  loginModal.style.display = "flex";
};

// Close modal if clicked outside
window.onclick = function (event) {
  if (event.target === loginModal) loginModal.style.display = "none";
  if (event.target === registerModal) registerModal.style.display = "none";
};

});
