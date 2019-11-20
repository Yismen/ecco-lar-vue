<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapillusDailyPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capillus_daily_performances', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->index()->unique();
            $table->double('calls_offered', 15, 8)->default(0);
            $table->double('calls_answered', 15, 8)->default(0);
            $table->double('short_abandons', 15, 8)->default(0);
            $table->double('long_abandons', 15, 8)->default(0);
            $table->double('cap_ultra', 15, 8)->default(0);
            $table->double('cap_plus', 15, 8)->default(0);
            $table->double('cap_pro', 15, 8)->default(0);
            $table->double('total_revenue', 15, 8)->default(0);
            $table->double('inbound_minutes', 15, 8)->default(0);
            $table->double('call_back', 15, 8)->default(0);
            $table->double('caller_hung_up_after_pitch', 15, 8)->default(0);
            $table->double('doesn_t_have_a_credit_debit_card_paypal', 15, 8)->default(0);
            $table->double('doesn_t_want_to_pay_with_credit_debit_card', 15, 8)->default(0);
            $table->double('insufficient_funds', 15, 8)->default(0);
            $table->double('just_wants_information', 15, 8)->default(0);
            $table->double('misunderstood_offer', 15, 8)->default(0);
            $table->double('needs_to_speak_with_spouse', 15, 8)->default(0);
            $table->double('not_interested', 15, 8)->default(0);
            $table->double('sent_to_web_for_financing_no_sale_secured', 15, 8)->default(0);
            $table->double('too_expensive', 15, 8)->default(0);
            $table->double('will_think_about_it', 15, 8)->default(0);
            $table->double('already_a_customer', 15, 8)->default(0);
            $table->double('caller_hung_up_less_than_20_sec', 15, 8)->default(0);
            $table->double('customer_care_after_hours', 15, 8)->default(0);
            $table->double('dead_air', 15, 8)->default(0);
            $table->double('do_not_call', 15, 8)->default(0);
            $table->double('fax_machine_telephone_problem', 15, 8)->default(0);
            $table->double('language_barrier', 15, 8)->default(0);
            $table->double('other_catchall', 15, 8)->default(0);
            $table->double('prank_call', 15, 8)->default(0);
            $table->double('test_call', 15, 8)->default(0);
            $table->double('transfer_customer_service_question_issue', 15, 8)->default(0);
            $table->double('transfer_physician_doctor', 15, 8)->default(0);
            $table->double('wrong_number', 15, 8)->default(0);
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
        Schema::dropIfExists('capillus_daily_performances');
    }
}
