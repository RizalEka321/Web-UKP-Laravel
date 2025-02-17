<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>UKP | @yield('title')</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dashboard/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/templatemo-edu-meeting.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/lightbox.css') }}">
    @stack('css')
</head>

<body>
    @include('page.layout.navbar')
    @yield('content')
    @include('page.layout.footer')

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ config('app.url') }}/assets/modules/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="{{ asset('js/chart-kategori-home.js') }}"></script>
    <script src="{{ asset('js/chart-prodi-home.js') }}"></script>
    <script src="{{ asset('js/chart-utama-home.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('dashboard/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/lightbox.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/tabs.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/video.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/slick-slider.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom.js') }}"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
            var
                direction = section.replace(/#/, ''),
                reqSection = $('.section').filter('[data-section="' + direction + '"]'),
                reqSectionPos = reqSection.offset().top - 0;

            if (isAnimate) {
                $('body, html').animate({
                        scrollTop: reqSectionPos
                    },
                    800);
            } else {
                $('body, html').scrollTop(reqSectionPos);
            }

        };

        var checkSection = function checkSection() {
            $('.section').each(function() {
                var
                    $this = $(this),
                    topEdge = $this.offset().top - 80,
                    bottomEdge = topEdge + $this.height(),
                    wScroll = $(window).scrollTop();
                if (topEdge < wScroll && bottomEdge > wScroll) {
                    var
                        currentId = $this.data('section'),
                        reqLink = $('a').filter('[href*=\\#' + currentId + ']');
                    reqLink.closest('li').addClass('active').
                    siblings().removeClass('active');
                }
            });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function(e) {
            e.preventDefault();
            showSection($(this).attr('href'), true);
        });

        $(window).scroll(function() {
            checkSection();
        });
    </script>
</body>

</html>
