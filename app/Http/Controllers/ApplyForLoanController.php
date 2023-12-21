<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplyForLoanModel;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoanApplicationRequest;
// Add this line
 // Import the DateTime class

class ApplyForLoanController extends Controller
{
    public function index()
    {

        return view('pages.apply_for_loan');
    }



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'pan_number' => 'required|unique:apply_for_loan_models,pan_number|string|max:10',
            'credit_score' => 'required|string|max:10',
            'loan_amount' => 'required|string|max:10',
            'gender' => 'required|in:male,female,other',
            'phone_number' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer',
            'address' => 'required|string|max:255',
            'pincode' => 'required|string|max:6',
            'company' => 'required|string|max:255',
            'current_salary' =>'required|string|max:255',
            'previous_salary' => 'required|string|max:255',
            'owns_house' => 'required|in:yes,no',
            'rent_amount' => 'required|string|max:255',
            'grocery_expense' => 'required|string|max:255',
            'current_emis' => 'required|string|max:255',
            'previous_hike_date' => 'required|date',
            'next_hike_date' => 'required|date',
            'account_type' => 'required|in:salary,savings',
            'bank_name' => 'required|string|max:255',
            'family_income' =>'required|numeric',
            'family_number' => 'required|integer',
            'marital_status' =>'required|in:married,unmarried',
            'children_count' =>'required|integer',
        ], [
            'full_name.required' => 'Please enter your full name.',
            'pan_number.required' => 'Please enter your PAN number.',
            'pan_number.unique' => 'This PAN number has already been used for a loan application.',
            'credit_score.max' => 'Credit score should not exceed 10 characters.',
            'loan_amount.max' => 'Loan amount should not exceed 10 characters.',
            'pincode.max' => 'Pincode should not exceed 6 characters.',
            'previous_hike_date.date' => 'Please enter a valid date for the previous hike.',
            'next_hike_date.date' => 'Please enter a valid date for the estimated next hike.',
            'gender.in' => 'Please select a valid gender.',
            'phone_number.max' => 'Phone number should not exceed 255 characters.',
            'address.max' => 'Address should not exceed 255 characters.',
            'company.max' => 'Company name should not exceed 255 characters.',
            'current_salary.max' => 'Current salary should not exceed 255 characters.',
            'previous_salary.max' => 'Previous salary should not exceed 255 characters.',
            'owns_house.in' => 'Please select a valid option for owning a house.',
            'rent_amount.max' => 'Rent amount should not exceed 255 characters.',
            'grocery_expense.max' => 'Grocery expense should not exceed 255 characters.',
            'current_emis.max' => 'Current EMIs expense should not exceed 255 characters.',
            'account_type.in' => 'Please select a valid account type.',
            'bank_name.required' => 'Please enter your Bank name.',
            'family_income.numeric' => 'Please enter a valid numeric value for family income.',
            'family_number.integer' => 'Please enter a valid integer value for family members count.',
            'marital_status.in' => 'Please select a valid marital status.',
            'children_count.integer' => 'Please enter a valid integer value for the number of children.',
        ],
    );


        $data['interest_rate'] = $this->calculateInterestRate($data);
        $data['eligibility'] = $this->calculateEligibility($data);
        $data['repayment_period'] = $this->calculateRepaymentPeriod($data);
        $data['loanAmountProvided'] = $this->calculateLoanAmountProvided($data);
        $data['emi'] = $this->calculateEMI($data);
        $data['risk_score'] = $this->calculateRiskScore($data);
        $creditScore = (float)filter_var($request->input('credit_score'), FILTER_SANITIZE_NUMBER_FLOAT);
        $data['credit_score'] = $creditScore;

        $loanProvided = $this->calculateLoanAmountProvided($data);
        echo "Loan Amount Provided: $loanProvided";

        $emi = $this->calculateEMI($data);
        $repaymentPeriodMonths = min($data['repayment_period'] * 12, 12);
        $totalRepaymentAmount = $emi * $repaymentPeriodMonths;
        $totalInterestAmount = $totalRepaymentAmount - $loanProvided;

        $data['total_repayment_amount'] = $totalRepaymentAmount;
        $data['total_interest_amount'] = max($totalInterestAmount, 0);
        $data['repayment_period_months'] = $repaymentPeriodMonths;
        $data['user_id'] = Auth::id();
        ApplyForLoanModel::create($data);
        session(['data' => $data]);
        $user = Auth::user();


        if ($user) {

            $user->update([
                'applied_loan' => 1,
            ]);

            return redirect()->route('apply')->withMessage("Application Submitted Successfully" );
        } else {

            return redirect()->route('profile')->withError("User not authenticated");
        }
    }

    private function calculateLoanAmountProvided(array $data): float
    {
        $loanAmountRequested = $data['loan_amount'];

        // Calculate the loan amount provided based on certain criteria
        $loanAmountProvided = $loanAmountRequested;

        // Deduct existing EMIs from the loan amount requested
        $loanAmountProvided -= $data['current_emis'] * 12;

        // Deduct monthly grocery expenses from the remaining loan amount
        $loanAmountProvided -= $data['grocery_expense'] * 12;

        // Calculate the risk score for the applicant
        $riskScore = $this->calculateRiskScore($data);

        // Apply adjustments based on risk score
        if ($riskScore > 20) {
            // Reduce by 25% for high-risk applicants
            $loanAmountProvided *= 0.75;
        } elseif ($riskScore > 10) {
            // Reduce by 10% for moderate-risk applicants
            $loanAmountProvided *= 0.90;
        } else {
            // Reduce by 5% for low-risk applicants
            $loanAmountProvided *= 0.95;
        }

        // Ensure the loan amount provided is not less than zero
        $loanAmountProvided = max($loanAmountProvided, 0);

        // Apply further adjustments based on applicant's income and credit score
        $income = $data['current_salary']*12;
        if ($income >= 50000) {
            // Increase the loan amount by 10% for higher income applicants
            $loanAmountProvided *= 1.10;
        }
        if ($data['credit_score'] >= 750) {
            // Increase the loan amount by 5% for higher credit score applicants
            $loanAmountProvided *= 1.05;
        }

        return $loanAmountProvided;
    }

    private function calculateEligibility(array $data): bool {
        // Check if the applicant meets the minimum salary requirement
        $minimumSalary = 20000;
        $isSalaryEligible = isset($data['current_salary']) && $data['current_salary'] >= $minimumSalary;

        // Check if the applicant has a stable job
      //  $jobTenure = $this->calculateJobTenure($data['previous_hike_date'], $data['next_hike_date']);
      //  $isJobStable = $jobTenure >= 1;

        // Check if the applicant has a good credit score
        $creditScore = $data['credit_score'];
        $isCreditGood = $creditScore >= 700;

        // Calculate eligibility based on conditions
        $isEligible = $isSalaryEligible && $isCreditGood;

        return $isEligible;
    }


    private function calculateRepaymentPeriod(array $data): int
    {
        // Set the default repayment period to 12 months
        $repaymentPeriod = 12;

        // Check a different condition to determine the repayment period
        // For instance, checking the credit score
        $creditScore = $data['credit_score'];
        if ($creditScore >= 750) {
            // Increase the repayment period to 24 months for higher credit scores
            $repaymentPeriod = 24;
        }

        // You can add more conditions based on your specific criteria

        return $repaymentPeriod;
    }
    private function calculateEMI(array $data): float
    {
        // Now, access the interest rate directly from the $data array
        $p = $data['loanAmountProvided'];
        $r = $data['interest_rate'] / 1200; // Using the calculated interest rate
        $n = min($data['repayment_period'] * 12, 12); // Maximum of 12 months
        $emi = ($p * $r * pow((1 + $r), $n)) / (pow((1 + $r), $n) - 1);

        return $emi;
    }


     private function calculateRiskScore(array $data): float
    {
        // Calculate the risk score based on the applicant's profile
        $riskScore = 0;

        // Check if the applicant has a stable job
        $jobTenure = $this->calculateJobTenure($data['previous_hike_date'], $data['next_hike_date']);
        if ($jobTenure < 1) {
            $riskScore += 20;
        } elseif ($jobTenure >= 1 && $jobTenure < 2) {
            $riskScore += 10;
        }

        // Retrieve the credit score provided by the user from the form input
        $creditScore = isset($data['credit_score']) ? (float) $data['credit_score'] : 0;

        if ($creditScore < 700) {
            $riskScore += 20;
        } elseif ($creditScore >= 700 && $creditScore < 800) {
            $riskScore += 10;
        }

        // Check if the applicant has any existing EMIs
        if ($data['current_emis'] > 0) {
            $riskScore += 10;
        }

        // Check if the applicant owns a house
        if ($data['owns_house'] == false) {
            $riskScore += 10;
        }

        return $riskScore;
    }

    private function calculateJobTenure($dateOfPreviousHike, $estimatedDateOfNextHike): float
    {
        $date1 = new DateTime($dateOfPreviousHike);
        $date2 = new DateTime($estimatedDateOfNextHike);
        $interval = $date1->diff($date2);
        $jobTenure = $interval->y + ($interval->m / 12);
        return $jobTenure;
    }
    private function calculateInterestRate(array $data): float
{
    // Define the base interest rate based on your criteria
    $baseRate = 8.5; // Set a default base rate

    // Get the credit score from the data array
    $creditScore = $data['credit_score'];

    // Adjust the base rate based on credit score
    if ($creditScore >= 750) {
        $baseRate -= 0.5;
    } elseif ($creditScore >= 650 && $creditScore < 750) {
        $baseRate -= 0.25;
    } elseif ($creditScore < 650) {
        $baseRate += 0.25;
    }

    // Apply additional adjustments based on other factors if necessary

    return $baseRate;
}

    // private function calculateCreditScore($panNumber): float
    // {
    //     // Fetch the credit score from the credit bureau
    //     $creditScore = DB::table('credit_scores')->where('pan_number', $panNumber)->first()->credit_score;

    //     return $creditScore;
    // }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
    public function status()
    {
        $user = auth()->user(); // Get the authenticated user

        // Initialize user data variable
        $userData = null;

        if ($user) {
            // Retrieve user data from the ApplyForLoanModel based on the user ID
            $userData = ApplyForLoanModel::where('user_id', $user->id)->first();
        }

        return view('pages.application_status', ['userData' => $userData]);
    }
}
