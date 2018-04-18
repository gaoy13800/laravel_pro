<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentauditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'agent_audit',
            function (Blueprint $table){
                $table->increments('id')->comment('主键');
                $table->integer('type')->comment('类型：1小区，2停车场，3其他，4物业')->nullable();
                $table->tinyInteger('is_latch')->comment('是否有门闸1是2否')->nullable();
                $table->string('commitDate')->comment('提交日期')->nullable();
                $table->string('agentName')->comment('代理商名称')->nullable();
                $table->string('agentId')->comment('代理商Id')->nullable();
                $table->string('region')->comment('代理地区')->nullable();
                $table->string('agencyName')->comment('代理业务名称')->nullable();
                $table->integer('agencyId')->comment('代理业务ID')->nullable();
                $table->string('propertyName')->comment('物业名称')->nullable();
                $table->integer('propertyId')->comment('代理商服务平台自增物业id')->nullable();
                $table->string('place')->comment('位置')->nullable();
                $table->string('longitude')->comment('经度')->nullable();
                $table->tinyInteger('is_completed')->comment('是否完善信息1是2否')->nullable();
                $table->string('latitude')->comment('维度')->nullable();
                $table->string('phone')->comment('联系电话')->nullable();
                $table->string('remark')->comment('备注')->nullable();
                $table->string('describe')->comment('描述')->nullable();
                $table->string('attachmentFileId')->comment('附件下载地址')->nullable();
                $table->string('attachmentName')->comment('附件')->nullable();
                $table->integer('auditStatus')->comment('审批进度,3未通过，2通过，1待审批')->nullable();
                $table->string('auditRemark')->comment('审核意见')->nullable();
                $table->string('commission')->comment('分佣占比')->nullable();
                $table->integer('disabledTime')->comment('间隔时间')->nullable();
                $table->integer('remoteId')->comment('commonId 业务id')->nullable();
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
        Schema::dropIfExists('agent_audit');
    }
}
