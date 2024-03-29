<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('storage/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('storage/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('storage/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('storage/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('storage/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('storage/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('storage/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('storage/js/dashboards-analytics.js') }}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Active Transformation in Sidebar -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all menu items
                menuItems.forEach(item => {
                    item.classList.remove('active');
                });

                // Add active class to the clicked menu item
                this.classList.add('active');
            });
        });
    });
</script>

@yield('script')
@yield('script-bottom')
