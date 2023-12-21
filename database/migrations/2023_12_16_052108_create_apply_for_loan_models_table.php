<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyForLoanModelsTable extends Migration
{
    public function up()
    {
        Schema::create('apply_for_loan_models', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('pan_number')->nullable();
            $table->integer('credit_score')->nullable();
            $table->decimal('loan_amount', 10, 2)->nullable();
            $table->string('gender')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('address')->nullable();
            $table->string('pincode')->nullable();
            $table->string('company')->nullable();

            $table->decimal('current_salary', 10, 2)->nullable();
            $table->decimal('previous_salary', 10, 2)->nullable();
            $table->string('owns_house')->nullable();
            $table->decimal('rent_amount', 10, 2)->nullable();
            $table->decimal('grocery_expense', 10, 2)->nullable();
            $table->decimal('current_emis', 10, 2)->nullable();
            $table->date('previous_hike_date')->nullable();
            $table->date('next_hike_date')->nullable();
            $table->string('account_type')->nullable();
            $table->string('bank_name')->nullable();
            $table->decimal('family_income', 10, 2)->nullable();
            $table->integer('family_number')->nullable();
            $table->string('marital_status')->nullable();
            $table->integer('children_count')->nullable();
            $table->decimal('interest_rate', 5, 2)->nullable();
            $table->integer('eligibility')->nullable();
            $table->integer('repayment_period')->nullable();
            $table->decimal('emi', 15, 10)->nullable();
            $table->integer('risk_score')->nullable();
            $table->decimal('repayment_period_months', 10, 2)->nullable();
            $table->decimal('total_interest_amount', 10, 2)->nullable();
            $table->decimal('total_repayment_amount', 10, 2)->nullable();

            $table->decimal('loanAmountProvided', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apply_for_loan_models');
    }
}
