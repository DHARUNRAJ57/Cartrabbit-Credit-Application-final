@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Apply For Loan'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="container-fluid py-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="text-center">
                                    <h2>🚀 Your Loan Application Journey 🚀</h2>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($userData && $userData->eligibility)
                                    <div class="text-center">
                                        <h1>🎉 Great News! You're Eligible for a Loan! 🎉</h1>
                                        <p>We're excited to share the details of your loan offer:</p>
                                    </div>
                                    <div class="mt-4">
                                        <h3>📝 Loan Details 📝</h3>
                                        <ul>
                                            <li>Loan Amount: <b>₹{{ number_format($userData->loanAmountProvided, 0) }}</b></li>
                                            <li>Interest Rate: <b>{{ $userData->interest_rate }}%</b></li>
                                            <li>Monthly EMI: <b>₹{{ number_format($userData->emi,0) }}</b></li>
                                            <li>Total Interest: <b>₹{{ number_format($userData->total_interest_amount,0) }}</b></li>
                                            <li>Total Repayment Amount: <b>₹{{ number_format($userData->total_repayment_amount,0) }}</b></li>
                                            <li>Repayment Period: <b>{{ number_format($userData->repayment_period_months,0) }} Months</b></li>
                                            <li>Risk Score: <b>{{ $userData->risk_score }}</b></li>
                                        </ul>
                                    </div>
                                @elseif(!$userData)
                                    <div class="text-center">
                                        <h1>👋 Hello! Ready to Apply for a New Loan? 👋</h1>
                                        <p>Click the button below to start your loan application journey with us.</p>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-primary btn-x mb-0 w-200" href="{{ route('apply') }}" type="button">
                                            📝 Start My Loan Application 📝
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <h1>😔 We're Sorry, Your Loan Application Was Not Approved 😔</h1>
                                        <p>Don't be discouraged. There are many factors that go into loan approval. Feel free to apply again or reach out to our support team for assistance.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection


@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
