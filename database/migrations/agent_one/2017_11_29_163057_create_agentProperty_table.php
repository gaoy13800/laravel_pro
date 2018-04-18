<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_property', function (Blueprint $table) {
            $table->increments('propertyId')->comment('物业ID,主键');
            $table->integer('agentId')->comment('代理商ID')->nullable();
            $table->integer('agentPropertyId')->comment('代理商服务平台物业Id')->nullable();
            $table->integer('propertyPlatformId')->comment('物业服务平台物业Id')->nullable();
            $table->string('propertyName', 20)->comment('物业名称')->nullable();
            $table->string('propertyPosition', 50)->comment('物业地址')->nullable();
            $table->string('propertyPhone',11)->comment('手机号')->nullable();
            $table->string('propertyRemark')->comment('备注')->nullable();
            $table->string('propertyAttachmentId',50)->comment('附件ID')->nullable();
            $table->string('propertyAttachmentName',100)->comment('附件名称')->nullable();
            $table->integer('propertyStatus')->comment('状态 1 待审核 2 已通过 3 未通过')->nullable();
            $table->string('propertySubmitTime',50)->comment('提交日期')->nullable();
            $table->string('propertyAuditOpinion')->comment('审核意见')->nullable();
            $table->string('created_at')->comment('创建时间')->nullable();
            $table->string('updated_at')->comment('修改时间')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_property');
    }
}
