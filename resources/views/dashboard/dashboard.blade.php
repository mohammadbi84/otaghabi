@extends('dashboard.layout.master')

{{-- title --}}
@section('title')
    <title>داشبورد مدیریت</title>
@endsection

{{-- body --}}
@section('body')
    <div class="col-10 px-4 pb-5">
        <!-- users and quick acsses -->
        <div class="row mt-4 rounded-4">
            <div class="col-md-3 mt-3">
                <a href="#" class="text-reset">
                    <div
                        class="d-flex justify-content-start align-items-center bg-white p-3 rounded-4 shadow bg-white h-100">
                        <img src="{{ asset('files/dashboard/calendar-check-solid-full.svg') }}" class="" alt="plus" width="60px"
                            height="60px">
                        <div class="text-end me-2 pt-2">
                            <h5>نوبت های جدید</h5>
                            <p>{{$appointment}} <span class="mx-1">نوبت</span></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="#" class="text-reset">
                    <div
                        class="d-flex justify-content-start align-items-center bg-white p-3 rounded-4 shadow bg-white h-100">
                        <img src="{{ asset('files/dashboard/cart-shopping-solid-full.svg') }}" class="" alt="plus"
                            width="60px" height="60px">
                        <div class="text-end me-2 pt-2">
                            <h5>سفارش های جدید</h5>
                            <p>0 <span class="mx-1">سفارش</span></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="#" class="text-reset">
                    <div
                        class="d-flex justify-content-start align-items-center bg-white p-3 rounded-4 shadow bg-white h-100">
                        <img src="{{ asset('files/dashboard/comment-dots-solid-full.svg') }}" class="" alt="plus"
                            width="60px" height="60px">
                        <div class="text-end me-2 pt-2">
                            <h5>نظر های جدید</h5>
                            <p>{{$comments->count()}} <span class="mx-1">نظر</span></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="#" class="text-reset">
                    <div
                        class="d-flex justify-content-start align-items-center bg-white p-3 rounded-4 shadow bg-white h-100">
                        <img src="{{ asset('files/dashboard/message-solid-full.svg') }}" class="" alt="plus" width="60px"
                            height="60px">
                        <div class="text-end me-2 pt-2">
                            <h5>پیام جدید</h5>
                            <p>{{$messages_count}} <span class="mx-1">پیام</span></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row my-4">

            <!-- بازدیدها -->
            <div class="col-md-6 mb-4">
                <div class="rounded-4 shadow bg-white p-2">
                    <canvas id="visitsChart" height="200"></canvas>
                </div>
            </div>

            <!-- کاربران جدید -->
            <div class="col-md-6 mb-4">
                <div class="rounded-4 shadow bg-white p-2">
                    <canvas id="usersChart" height="200"></canvas>
                </div>
            </div>

            <!-- نظرات -->
            <div class="col-md-6">
                <div class="rounded-4 shadow bg-white p-2">
                    <canvas id="commentsChart" height="150"></canvas>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('javaScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <script>
        new Chart("myChart", {
            type: "bar",
            data: {
                labels: ['label1', 'label2', 'label3', 'label4', 'label5', 'label6'],
                datasets: [{
                    data: ['1', '2', '3', '4', '5', '6'],
                    label: 'مراجع',
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(54, 162, 235)',
                    ],
                    borderWidth: 1,
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "مراجعین در ماه های اخیر",
                    fontColor: "#000",
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: "#000", // this here
                        },
                    }],
                    yAxes: [{
                        ticks: {
                            fontColor: "#000", // this here
                            beginAtZero: true,

                        },
                    }],
                },
            }
        });


        // const xValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
        // const yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];
        new Chart("linechart", {
            type: 'line',
            data: {
                labels: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور'],
                datasets: [{
                    label: 'نمودار خطی',
                    data: [10, 20, 15, 25, 30, 20],
                    borderColor: 'rgb(54, 162, 235)', // رنگ خط
                    borderWidth: 2,
                    fill: false // جلوگیری از رنگی شدن زیر نمودار
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        var xValues1 = ["درآمد های جانبی", "درآمد از تراکنش ها"];
        var yValues1 = ['1000', '2000'];
        new Chart("myChart2", {
            type: "doughnut",
            data: {
                labels: xValues1,
                datasets: [{
                    label: 'My First Dataset',
                    data: yValues1,
                    backgroundColor: [
                        '#00FFAB',
                        '#14C38E',
                        '#00FF9C',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "نمودار کل درآمد ها"
                }
            }
        });


        new Chart("myChart3", {
            type: "doughnut",
            data: {
                labels: ['هزینه های جانبی'],
                datasets: [{
                    label: 'My First Dataset',
                    data: ['1000'],
                    backgroundColor: [
                        '#F72C5B',
                        'red',
                        '#FF748B',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "نمودار کل هزینه ها"
                }
            }
        });
    </script>
    <script>
        const months = {!! json_encode($months) !!};

        // بازدیدها
        new Chart(document.getElementById('visitsChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'بازدیدها',
                    data: {!! json_encode($visits) !!},
                    borderColor: '#36a2eb',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });

        // کاربران
        new Chart(document.getElementById('usersChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'کاربران جدید',
                    data: {!! json_encode($users) !!},
                    borderColor: '#4bc0c0',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            }
        });

        // نظرات
        new Chart(document.getElementById('commentsChart'), {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'نظرات ثبت‌شده',
                    data: {!! json_encode($comments) !!},
                    backgroundColor: '#ff6384',
                }]
            }
        });
    </script>
@endsection
