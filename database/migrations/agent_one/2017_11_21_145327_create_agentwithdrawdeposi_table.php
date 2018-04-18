<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentwithdrawdeposiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'agent_withdraw_deposit',
            function (Blueprint $table){
                $table->increments('operId')->comment('主键');
                $table->integer('agentId')->comment('代理商Id');
                $table->integer('agentOperId')->comment('代理商服务平台提现申请Id');
                $table->string('commitDate', 20)->comment('提交日期');
                $table->string('agentName', 20)->comment('代理商名字')->nullable();
                $table->decimal('deposit')->comment('提现金额')->nullable();
                $table->string('cardNum', 20)->comment('银行卡号')->nullable();
                $table->string('depositBank', 20)->comment('开户银行')->nullable();
                $table->string('accountName', 20)->comment('账户名称')->nullable();
                $table->integer('commitStatus')->comment('提现状态，1已处理，2未处理')->nullable();
                $table->string('created_at')->comment('创建日期')->nullable();
                $table->string('updated_at')->comment('审核日期')->nullable();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_withdraw_deposit');
    }
}
