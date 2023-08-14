document.addEventListener("DOMContentLoaded", function (event) {
    const showNavbar = (toggleId, navId, bodyId, headerId, admId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId),
            adm = document.getElementById(admId);
        var x = window.matchMedia("(max-width: 600px)");
        if (x.matches) {
            // If media query matches
            // show navbar
            nav.classList.remove("show");
            // change icon
            toggle.classList.add("bx-menu");
            // remove icon
            toggle.classList.remove("bx-chevrons-left");
            // add padding to body
            bodypd.classList.remove("body-pd");
            // add padding to header
            headerpd.classList.remove("body-pd");
            // Admin text hide or show
            adm.classList.remove("d-none");
        }

        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener("click", () => {
                // show navbar
                nav.classList.toggle("show");
                // change icon
                toggle.classList.toggle("bx-menu");
                // remove icon
                toggle.classList.toggle("bx-chevrons-left");
                // add padding to body
                bodypd.classList.toggle("body-pd");
                // add padding to header
                headerpd.classList.toggle("body-pd");
                // Admin text hide or show
                adm.classList.toggle("d-none");
            });
        }
    };

    showNavbar("header-toggle", "nav-bar", "body-pd", "header", "adm");

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll(".nav_link");

    function colorLink() {
        if (linkColor) {
            linkColor.forEach((l) => l.classList.remove("active"));
            this.classList.add("active");
        }
    }
    linkColor.forEach((l) => l.addEventListener("click", colorLink));
    // Your code to run since DOM is loaded and ready
});
