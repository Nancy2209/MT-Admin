<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel-Admin</title>

    <!--Font awesome icons-->
    <link href="{{ asset('assets/fonts/font-awesome5-free/css/all.min.css') }}" rel="stylesheet">

    <!--Google web fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">


    <!--Simplebar css-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/simplebar.min.css') }}">

    <!--Choices css-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/choices.min.css') }}">

    <!--Date range picker-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/daterangepicker.css') }}">
    <link href="{{ asset('assets/vendor/css/quill.snow.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap5.min.css">

    <!--Main style-->
    @if (Session::get('theme') == 'light')
        <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" id="switchThemeStyle">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/style.dark.min.css') }}" id="switchThemeStyle">
    @endif
</head>
<style>
    .error {
        color: red;
        display: block;
    }

    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        background: transparent;
        background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
        background-repeat: no-repeat;
        background-position-x: 100%;
        background-position-y: 5px;
        border: 1px solid #dfdfdf;
        border-radius: 2px;
        margin-right: 2rem;
        padding: 1rem;
        padding-right: 2rem;
    }
</style>

<body>


    <!--////////////////// PreLoader Start//////////////////////-->
    <div class="loader">
        <!--Placeholder animated layout for preloader-->
        <div class="d-flex flex-column flex-root">
            <div class="page d-flex flex-row flex-column-fluid">

                <!--Sidebar start-->
                <aside class="page-sidebar aside-dark placeholder-wave">
                    <div class="placeholder col-12 h-100 bg-gray"></div>
                </aside>
                <div class="page-content d-flex flex-column flex-row-fluid">
                    <div
                        class="content flex-column p-4 pb-0 d-flex justify-content-center align-items-center flex-column-fluid position-relative">
                        <div class="w-100 h-100 position-relative d-flex align-items-center justify-content-center">
                            <i class="anim-spinner fas fa-spinner me-3"></i>
                            <div>
                                <span>Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--////////////////// /.PreLoader END//////////////////////-->

    <div class="d-flex flex-column flex-root">
        <!--Page-->
        <div class="page d-flex flex-row flex-column-fluid">

            @include('Common.SideBar')
            <main class="page-content d-flex flex-column flex-row-fluid">
                <!--//page-header//-->
                @include('Common.Header')
                <!--Main Header End-->
                <!--///////////Page content wrapper///////////////-->


                @yield('content')

            </main>
        </div>
    </div>

    <!--////////////Theme Core scripts Start/////////////////-->

    <script src="{{ asset('assets/js/theme.bundle.js') }}"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!--////////////Theme Core scripts End/////////////////-->


    <!--Charts-->
    <script src="{{ asset('assets/vendor/apexcharts.min.js') }}"></script>
    <!--Dashboard duration calendar-->
    <script src="{{ asset('assets/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/daterangepicker.js') }}"></script>

    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatable").DataTable({
                "filter": false,
                "length": false
            });
        });
        $("input[type='file']").on("change", function() {
            if (this.files[0].size > 5000000) {
                alert("Please upload the file less than 5MB.");
                $(this).val('');
            }
        });

        $(document).on('submit', '.ajaxForm', function() {
            var $this = $(this);
            setTimeout(function() {
                $this.find(':input[type=submit]').attr('disabled', 'disabled')
            }, 1);
        });

        $(document).ready(function() {
            $('.alert-block').fadeOut(5000); // 5 seconds x 1000 milisec = 5000 milisec
        });
    </script>


    <script src="{{ asset('assets/vendor/quill.min.js') }}  "></script>
    <script>
        var initQuill = document.querySelectorAll("[data-quill]");
        initQuill.forEach((qe) => {
            const qt = {
                ...(qe.dataset.quill ? JSON.parse(qe.dataset.quill) : {}),
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, false]
                        }],
                        ["bold", "underline"],
                        ["link", "blockquote", "code", "image"],
                        [{
                            list: "ordered"
                        }, {
                            list: "bullet"
                        }]
                    ]
                },
                theme: "snow"
            };
            new Quill(qe, qt);
        });
    </script>
    <script>
        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });

        var cPrimary = "#4444ff";
        var cWarning = "#ff914d";
        var cSecondary = "#ff5272";
        var cSuccess = "#07bfa5";
        var cMuted = "#9d9da7";
        var cBodycolor = "#626273";
        var cLight = "#e7e7e9";
        var cGray = "#ced2e1";
        var cFont = "$font-family-base";

        //-----------------------Bar Chart------------------
        new ApexCharts(document.querySelector('#chart-earnings'), {
            chart: {
                fontFamily: cFont,
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false,
                }
            },
            colors: [cPrimary, cWarning],
            grid: {
                borderColor: cGray,
                strokeDashArray: 6,
                padding: {
                    top: 0,
                    right: 20,
                    bottom: 0,
                    left: 20
                },
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
            series: [{
                    name: 'Earnings',
                    data: [5717, 6432, 4214, 5214, 5021, 4212, 6247]
                },
                {
                    name: 'Orders',
                    data: [700, 365, 604, 394, 538, 789, 861]
                },
            ],
            xaxis: {
                labels: {
                    style: {
                        colors: cMuted,
                        fontFamily: cFont
                    }
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                tooltip: {
                    enabled: false
                },
                categories: ['Mon', 'Tue', 'Wed', 'Thr', 'Fri', 'Sat', 'Sun'],
                crosshairs: {
                    show: false,
                    fill: {
                        type: 'solid',
                        color: cPrimary
                    },
                    stroke: {
                        color: cLight,
                        width: 1,
                        dashArray: 6,
                    },
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: cMuted,
                        fontFamily: cFont
                    }
                },
                crosshairs: {
                    show: false,
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '40%',
                    borderRadius: 0,
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: false,
            },
            tooltip: {
                shared: true,
                intersect: false,
                labels: {
                    radius: 0,
                },
                y: [{
                        formatter: function(y) {
                            if (typeof y !== "undefined") {
                                return " $" + y.toFixed(0);
                            }
                            return y;
                        }
                    },
                    {
                        formatter: function(y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0) + " Items";
                            }
                            return y;
                        }
                    }
                ]
            },
            legend: {
                position: 'top',
                fontFamily: cFont,
                labels: {
                    colors: cMuted
                },
                markers: {
                    width: 12,
                    height: 12,
                    radius: 0
                }
            },
        }).render()

        //-----------------------Radial Bar Chart------------------

        new ApexCharts(document.querySelector('#chart-traffic'), {
            series: [{
                    name: ["Organic"],
                    data: [27, 26, 22, 20, 18, 15, 12]
                },
                {
                    name: ["Direct"],
                    data: [23, 22, 18, 16, 14, 9, 8]
                },
                {
                    name: ["Referral"],
                    data: [12, 10, 8, 7, 5, 3, 2]
                },
            ],
            chart: {
                fontFamily: cFont,
                height: 300,
                type: 'line',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            stroke: {
                width: 2,
                curve: 'straight'
            },
            colors: [cWarning, cPrimary, cSuccess],
            grid: {
                borderColor: cGray,
                strokeDashArray: 6,
                padding: {
                    top: 0,
                    right: 30,
                    bottom: 0,
                    left: 20
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                },
            },
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thr', 'Fri', 'Sat', 'Sun'],
                crosshairs: {
                    show: false
                },
                labels: {
                    style: {
                        colors: cMuted,
                        offsetX: -65,
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                tooltip: {
                    enabled: true
                },
            },
            yaxis: {
                labels: {
                    formatter: function(y) {
                        return y + "k"
                    },
                    style: {
                        offsetX: 15,
                        colors: cMuted,
                    },
                },

            },
            legend: {
                show: false
            }
        }).render()
    </script>

    <script>
        function addCss(theme) {
            var theme = theme;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{!! route('admin.theme.change') !!}', //the page containing php script
                type: "post", //request type,
                data: {
                    theme: theme,
                    _token: _token
                },
                success: function(result) {
                    return true
                }
            });
        }
    </script>

</body>

</html>
