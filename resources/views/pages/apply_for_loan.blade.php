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
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Application Form</p>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(auth()->user()->applied_loan == 0)
                                <form method="post" action="{{route('apply.store')}}">

                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="full_name" class="form-control-label">Full Name</label>
                                                <input type="text" name="full_name" class="form-control " aria-label="full_name">
                                                @error('full_name') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                            </div>


                                            <div class="col-md-6">
                                                <label for="pan_number" class="form-control-label">PAN Number</label>
                                                <input type="text" name="pan_number" class="form-control " aria-label="pan_number"  maxlength="10">
                                                @error('pan_number') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label for="credit_score" class="form-control-label">Credit Score</label>
                                            <input type="number" name="credit_score" class="form-control " aria-label="credit_score" maxlength="3">
                                                @error('credit_score') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="loan_amount" class="form-control-label">Loan Amount</label>
                                            <input type="number" name="loan_amount" class="form-control " aria-label="loan_amount">
                                            @error('loan_amount') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="gender" class="form-control-label">Gender</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                @error('gender') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                            </div>

                                        <div class="col-md-6">

                                            <label for="phone_number" class="form-control-label">Phone Number</label>
                                            <input type="number" name="phone_number" class="form-control " aria-label="phone_number">
                                            @error('phone_number') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="date_of_birth" class="form-control-label">Date of Birth</label>
                                            <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" >
                                            @error('date_of_birth') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="age" class="form-control-label">Age</label>
                                            <input type="number" id="age" name="age" class="form-control"  readonly>
                                            @error('age') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>
                                    </div>


                                    </div>
                                    <div class="row">
                                            <div class="col-md-6">
                                            <label for="address" class="form-control-label">Address</label>
                                            <input type="text" name="address" class="form-control " aria-label="address">
                                                @error('address') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="pincode" class="form-control-label">Pincode</label>
                                            <input type="number" name="pincode" class="form-control " aria-label="pincode">
                                            @error('pincode') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>
                                    </div>

                                        <div>
                                            <label for="company" class="form-control-label">Company Name</label>
                                            <input type="text" name="company" class="form-control " aria-label="company">
                                            @error('company') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="current_salary" class="form-control-label">Current Salary Per Month</label>
                                                <input type="number" name="current_salary" class="form-control " aria-label="current_salary">
                                                @error('current_salary') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="previous_salary" class="form-control-label">Previous Salary Per Month</label>
                                                <input type="number" name="previous_salary" class="form-control " aria-label="previous_salary">
                                                @error('previous_salary') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <label for="owns_house" class="form-control-label">Owns a House?</label>
                                            <select name="owns_house" id="owns_house" class="form-control">
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            @error('owns_house') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>

                                            <div class="col-md-6">
                                            <label for="rent_amount" class="form-control-label">Rent Expense per Month</label>
                                            <input type="number" name="rent_amount" class="form-control " aria-label="rent_amount">
                                                @error('rent_amount') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label for="grocery_expense" class="form-control-label">Approximate Grocery Expense per Month</label>
                                        <input type="number" name="grocery_expense" class="form-control " aria-label="grocery_expense">
                                        @error('grocery_expense') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="current_emis" class="form-control-label">Current EMIs Expense</label>
                                        <input type="number" name="current_emis" class="form-control " aria-label="current_emis">
                                        @error('current_emis') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="previous_hike_date" class="form-control-label">Date of Previous Hike</label>
                                        <input type="date" name="previous_hike_date" class="form-control " aria-label="previous_hike_date">
                                        @error('previous_hike_date') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror

                                    </div>
                                    <div class="col-md-6">
                                        <label for="next_hike_date" class="form-control-label">Estimated Date of Next Hike</label>
                                        <input type="date" name="next_hike_date" class="form-control " aria-label="next_hike_date">
                                        @error('next_hike_date') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="account_type" class="form-control-label">Account Type</label>
                                        <select name="account_type" id="account_type" class="form-control">
                                            <option value="salary">Salary Account</option>
                                            <option value="savings">Savings Account</option>
                                        </select>
                                        @error('account_type') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bank_name" class="form-control-label">Bank Name</label>
                                        <input type="text" name="bank_name" class="form-control " aria-label="bank_name">
                                    @error('bank_name') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                            <label for="family_income" class="form-control-label">Family Total Income</label>
                                            <input type="number" name="family_income" class="form-control " aria-label="family_income">
                                        @error('family_income') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="family_number" class="form-control-label">Total Family Member</label>
                                            <input type="number" name="family_number" class="form-control " aria-label="family_number">
                                            @error('family_number') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <label for="marital_status" class="form-control-label">Marital Status</label>
                                            <select name="marital_status" id="marital_status" class="form-control">
                                                <option value="married">Married</option>
                                                <option value="unmarried">Unmarried</option>
                                            </select>
                                            @error('marital_status') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="children_count" class="form-control-label">Number of Children</label>
                                            <input type="number" name="children_count" id="children_count" class="form-control">
                                            @error('children_count') <p class="text-danger text-xs pt-1"> {{$message}} </p> @enderror
                                        </div>

                                    </div>


                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Submit Application</button>
                                </form>
                                @endif
                                @if(auth()->user()->applied_loan == 1)
                                <div class="text-center">
                                    <h1>🎉 Congratulations! Your Loan Application is Soaring Through Our System! 🎉</h1>
                                    <p>We're thrilled that you've chosen us for your loan needs. Your application is being processed by our dedicated team.</p>
                                    <p>While you wait, why not check out our blog for some great financial tips and tricks? Or visit our FAQ section to learn more about our loan process.</p>
                                    <p>Can't wait to know the status of your application? We've got you covered!</p>
                                    <a class="btn btn-primary btn-x mb-0 w-200" href="{{ route('application_status') }}" type="button">
                                        🚀 Launch My Loan Status Tracker 🚀
                                    </a>
                                    <p>Thank you for trusting us with your loan needs. We're working hard to process your application.</p>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
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
    <script>
        document.getElementById('date_of_birth').addEventListener('change', function() {
            let dob = new Date(this.value);
            let today = new Date();
            let age = today.getFullYear() - dob.getFullYear();

            // Check if the birthday has occurred this year
            if (today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
                age--;
            }

            document.getElementById('age').value = age;
        });
    </script>
   
@endpush
