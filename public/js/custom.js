const sliderTrack = document.getElementById("sliderTrack");
const sliderItems = document.querySelectorAll(".slider-item img");

sliderItems.forEach((item) => {
    item.addEventListener("mouseover", () => {
        pauseTimeout = setTimeout(() => {
            sliderTrack.style.animationPlayState = "paused";
        });
    });

    item.addEventListener("mouseout", () => {
        sliderTrack.style.animationPlayState = "running";
    });
});

function showDetails(id, collapseId) {
    // Hide all details sections
    var details = document.querySelectorAll(".details-service");
    details.forEach(function (detail) {
        detail.style.display = "none";
    });

    // Show the selected details section
    document.getElementById(id).style.display = "block";

    // Collapse the accordion
    var collapseElement = document.getElementById(collapseId);
    var bsCollapse = new bootstrap.Collapse(collapseElement, {
        toggle: true,
    });

    // Close all other accordions
    var collapses = document.querySelectorAll(".accordion-collapse");
    collapses.forEach(function (collapse) {
        if (collapse.id !== collapseId) {
            var bsOtherCollapse = new bootstrap.Collapse(collapse, {
                toggle: false,
            });
            bsOtherCollapse.hide();
        }
    });
}

/* Reminder page scripts were moved to public/js/reminder.js */

// ===== SIDEBAR COLLAPSE & BURGER MENU =====
document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const backdrop = document.getElementById("backdrop");
    const btnSidebarCollapse = document.getElementById("btnSidebarCollapse");
    const btnSidebarMobile = document.getElementById("btnSidebarMobile");

    // Desktop: Toggle collapse sidebar
    if (btnSidebarCollapse) {
        btnSidebarCollapse.addEventListener("click", () => {
            document.body.classList.toggle("sidebar-collapsed");

            // Save state to localStorage
            if (document.body.classList.contains("sidebar-collapsed")) {
                localStorage.setItem("sidebarCollapsed", "true");
            } else {
                localStorage.removeItem("sidebarCollapsed");
            }
        });
    }

    // Mobile: Toggle sidebar visibility
    if (btnSidebarMobile) {
        btnSidebarMobile.addEventListener("click", () => {
            sidebar.classList.add("show");
            backdrop.classList.add("show");
        });
    }

    // Close sidebar when clicking backdrop
    if (backdrop) {
        backdrop.addEventListener("click", () => {
            sidebar.classList.remove("show");
            backdrop.classList.remove("show");
        });
    }

    // Restore collapse state from localStorage (desktop only)
    if (window.innerWidth >= 992) {
        if (localStorage.getItem("sidebarCollapsed") === "true") {
            document.body.classList.add("sidebar-collapsed");
        }
    }

    // Handle window resize
    window.addEventListener("resize", () => {
        if (window.innerWidth >= 992) {
            // Desktop: remove mobile classes
            sidebar.classList.remove("show");
            backdrop.classList.remove("show");
        } else {
            // Mobile: remove collapse class
            document.body.classList.remove("sidebar-collapsed");
        }
    });
});
