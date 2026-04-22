(function () {
    function init() {
        var toggle = document.getElementById('lpbNavToggle');
        var nav = document.getElementById('lpbMainNav');
        var backdrop = document.getElementById('lpbNavBackdrop');
        if (!toggle || !nav) {
            return;
        }
        var header = toggle.closest('header');
        if (!header) {
            return;
        }

        function setOpen(open) {
            header.classList.toggle('is-nav-open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            document.body.style.overflow = open ? 'hidden' : '';
            if (backdrop) {
                backdrop.hidden = !open;
                backdrop.setAttribute('aria-hidden', open ? 'false' : 'true');
            }
        }

        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            setOpen(!header.classList.contains('is-nav-open'));
        });

        nav.addEventListener('click', function (e) {
            if (e.target.closest('a')) {
                setOpen(false);
            }
        });

        if (backdrop) {
            backdrop.addEventListener('click', function () {
                setOpen(false);
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                setOpen(false);
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
