<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ApplyForLoanModel;
class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all records from the ApplyForLoanModel
        $allUserData = ApplyForLoanModel::all();

        // Calculate the total repayment amount from all user records
        $totalRepaymentAmount = $allUserData->sum('total_repayment_amount');
        $totalProvidedAmount = $allUserData->sum('loanAmountProvided');
        $totalInterestAmount = $allUserData->sum('total_interest_amount');

        // Retrieve the total count of users
        $totalUsersCount = User::count();

        // Pass the total repayment amount, user count, and user data to the view
        return view('pages.dashboard')->with([
            'totalRepaymentAmount' => $totalRepaymentAmount,
            'totalProvidedAmount' => $totalProvidedAmount,
            'totalInterestAmount' => $totalInterestAmount,
            'totalUsersCount' => $totalUsersCount,
            'allUserData' => $allUserData,
        ]);
    }
}
