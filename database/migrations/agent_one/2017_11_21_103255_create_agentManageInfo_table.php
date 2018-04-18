<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentManageInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'agent_manage_info',
            function (Blueprint $table){
                $table->increments('agentId')->comment('主键代理商Id');
                $table->string('agentName', 20)->comment('代理商姓名')->nullable();
                $table->string('agentRegion', 50)->comment('代理商地区')->nullable();
                $table->string('province',20)->comment('省份')->nullable();
                $table->string('city', 20)->comment('城市')->nullable();
                $table->string('area', 20)->comment('地区')->nullable();
                $table->string('agentPhone', 20)->comment('代理商手机号')->nullable();
                $table->string('agentAccount', 20)->comment('代理商账号')->nullable();
                $table->string('agentPassword', 50)->comment('代理商登录密码')->nullable();
                $table->string('agentStartTime', 50)->comment('开始代理时间')->nullable();
                $table->string('agentEndTime', 50)->comment('结束代理时间')->nullable();
                $table->integer('status')->comment('处理进度,1正常，2冻结，3过期')->nullable();
                $table->string('created_at')->comment('创建时间')->nullable();
                $table->string('updated_at')->comment('修改时间')->nullable();
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
        Schema::dropIfExists('agentManageInfo');
    }
}
