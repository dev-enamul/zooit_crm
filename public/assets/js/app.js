(function($) {
    "use strict";

    function removeActiveClass() {
        var links = document.getElementById("topnav-menu-content").getElementsByTagName("a");
        for (var i = 0; i < links.length; i++) {
            if (links[i].parentElement.getAttribute("class") === "nav-item dropdown active") {
                links[i].parentElement.classList.remove("active");
                links[i].nextElementSibling.classList.remove("show");
            }
        }
    }

    function handleScroll() {
        var pageTopbar = document.getElementById("page-topbar");
        if (pageTopbar) {
            if (50 <= document.body.scrollTop || 50 <= document.documentElement.scrollTop) {
                pageTopbar.classList.add("topbar-shadow");
            } else {
                pageTopbar.classList.remove("topbar-shadow");
            }
        }
    }

    $(document).ready(function() {
        $("#side-menu").metisMenu();

        $("#sidebar-btn").on("click", function(e) {
            e.preventDefault();
            $("body").toggleClass("sidebar-enable");
            if ($(window).width() >= 992) {
                $("body").toggleClass("sidebar-collpsed");
            } else {
                $("body").removeClass("sidebar-collpsed");
            }
        });

        // $("body,html").click(function(e) {
        //     var sidebarBtn = $("#sidebar-btn");
        //     if (!sidebarBtn.is(e.target) && sidebarBtn.has(e.target).length === 0 && !e.target.closest("div.vertical-menu")) {
        //         $("body").removeClass("sidebar-enable");
        //     }
        // });

        $("#sidebar-menu a").each(function() {
            var href = window.location.href.split(/[?#]/)[0];
            if (this.href === href) {
                $(this).addClass("active");
                $(this).parent().addClass("mm-active");
                $(this).parent().parent().addClass("mm-show");
                $(this).parent().parent().prev().addClass("mm-active");
                $(this).parent().parent().parent().addClass("mm-active");
                $(this).parent().parent().parent().parent().addClass("mm-show");
                $(this).parent().parent().parent().parent().parent().addClass("mm-active");
            }
        });

        $(".navbar-nav a").each(function() {
            var href = window.location.href.split(/[?#]/)[0];
            if (this.href === href) {
                $(this).addClass("active");
                $(this).parent().addClass("active");
                $(this).parent().parent().addClass("active");
                $(this).parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().parent().addClass("active");
            }
        });

        var sidebarMenu = $("#sidebar-menu");
        if (sidebarMenu.length > 0 && $("#sidebar-menu .mm-active .active").length > 0) {
            var topOffset = $("#sidebar-menu .mm-active .active").offset().top;
            if (topOffset > 300) {
                topOffset -= 300;
                $(".vertical-menu .simplebar-content-wrapper").animate({ scrollTop: topOffset }, "slow");
            }
        }
    });

    $('[data-toggle="fullscreen"]').on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("fullscreen-enable");
        if (document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement) {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
        } else {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        }
    });

    function exitFullscreen() {
        if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
            console.log("pressed");
            $("body").removeClass("fullscreen-enable");
        }
    }

    document.addEventListener("fullscreenchange", exitFullscreen);
    document.addEventListener("webkitfullscreenchange", exitFullscreen);
    document.addEventListener("mozfullscreenchange", exitFullscreen);

    $(".right-bar-toggle").on("click", function(e) {
        $("body").toggleClass("right-bar-enabled");
    });

    $(document).on("click", "body", function(e) {
        if ($(e.target).closest(".right-bar-toggle, .right-bar").length === 0) {
            $("body").removeClass("right-bar-enabled");
        }
    });

    (function() {
        if (document.getElementById("topnav-menu-content")) {
            var links = document.getElementById("topnav-menu-content").getElementsByTagName("a");
            for (var i = 0; i < links.length; i++) {
                links[i].onclick = function(e) {
                    if (e.target.getAttribute("href") === "#") {
                        e.target.parentElement.classList.toggle("active");
                        e.target.nextElementSibling.classList.toggle("show");
                    }
                };
            }
            window.addEventListener("resize", removeActiveClass);
        }
    })();

    $('[data-bs-toggle="tooltip"]').tooltip();
    $('[data-bs-toggle="popover"]').popover();

    $(window).on("load", function() {
        $("#status").fadeOut();
        $("#preloader").delay(350).fadeOut("slow");
    });

    (function() {
        var root = document.documentElement;
        if (root.hasAttribute("data-bs-theme")) {
            if (root.getAttribute("data-bs-theme") === "light") {
                sessionStorage.setItem("data-layout-mode", "light");
            } else if (root.getAttribute("data-bs-theme") === "dark") {
                sessionStorage.setItem("data-layout-mode", "dark");
            }
        } else {
            if (!sessionStorage.getItem("data-layout-mode")) {
                root.setAttribute("data-bs-theme", "light");
            } else if (sessionStorage.getItem("data-layout-mode")) {
                root.setAttribute("data-bs-theme", sessionStorage.getItem("data-layout-mode"));
            }
        }

        var lightDarkModeBtn = document.getElementById("light-dark-mode");
        if (lightDarkModeBtn) {
            lightDarkModeBtn.addEventListener("click", function() {
                if (root.hasAttribute("data-bs-theme")) {
                    if (root.getAttribute("data-bs-theme") === "dark") {
                        root.setAttribute("data-bs-theme", "light");
                        sessionStorage.setItem("data-layout-mode", "light");
                    } else {
                        root.setAttribute("data-bs-theme", "dark");
                        sessionStorage.setItem("data-layout-mode", "dark");
                    }
                }
            });
        }

        var layoutDirBtn = document.getElementById("layout-dir-btn");
        if (layoutDirBtn) {
            layoutDirBtn.addEventListener("click", function() {
                if (root.hasAttribute("dir")) {
                    if (root.getAttribute("dir") === "rtl") {
                        root.setAttribute("dir", "ltr");
                        document.getElementById("bootstrap-style").setAttribute("href", "assets/css/bootstrap.min.css");
                        document.getElementById("app-style").setAttribute("href", "assets/css/app.min.css");
                        this.innerHTML = "RTL";
                    } else {
                        root.setAttribute("dir", "rtl");
                        document.getElementById("bootstrap-style").setAttribute("href", "assets/css/bootstrap-rtl.min.css");
                        document.getElementById("app-style").setAttribute("href", "assets/css/app-rtl.min.css");
                        this.innerHTML = "LTR";
                    }
                }
            });
        }
    })();

    Waves.init();
})(jQuery);

$('.refresh_btn').click(function() {
    var form = $(this).closest('form')[0];
    form.reset();
});

$(window).on('load', function() {
    $(".preloader").fadeOut("slow");
});
