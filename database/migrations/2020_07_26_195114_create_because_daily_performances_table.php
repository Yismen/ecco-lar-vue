<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBecauseDailyPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('because_daily_performances', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->index();
            $table->integer("weekday");
            $table->string('campaign', 100)->index();
            $table->double("duration", 16, 8);
            $table->integer("calls");
            $table->integer("calls_answered");
            $table->integer("abandon");
            $table->integer("ivr_disconnects");
            $table->integer("already_a_customer");
            $table->integer("call_back");
            $table->integer("caller_hung_up_before_branding");
            $table->integer("caller_hung_up_during_pitch");
            $table->integer("cancel_order");
            $table->integer("customer_care_afterhours");
            $table->integer("customer_care_transferred");
            $table->integer("dead_air");
            $table->integer("doesnt_want_to_pay_with_creditdebit_card");
            $table->integer("fax_machine_or_telephone_problem");
            $table->integer("insufficient_funds");
            $table->integer("just_wants_information");
            $table->integer("language_barrier");
            $table->integer("misunderstood_offer");
            $table->integer("needs_to_speak_with_spouse");
            $table->integer("no_credit_or_debit_card");
            $table->integer("no_disposition");
            $table->integer("not_interested");
            $table->integer("objects_to_autorenew");
            $table->integer("prank_call");
            $table->integer("sale");
            $table->integer("test_call");
            $table->integer("too_expensive");
            $table->integer("transfer_customer_care");
            $table->integer("transfer_not_customer_care_issue");
            $table->integer("wants_product_but_not_subscription");
            $table->integer("will_think_about_it");
            $table->integer("wrong_number");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('because_daily_performances');
    }
}
