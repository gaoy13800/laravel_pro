<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentAuditOtherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_audit_other',function(Blueprint $table){
            $table->integer('auditId')->comment('审核ID，外键');
            $table->string('tradeArea')->comment('商圈')->nullable();
            $table->string('parkingNumber')->comment('车位号')->nullable();
            $table->decimal('price',8,2)->comment('车位价格')->nullable();
            $table->string('parking_mark')->comment('车位描述')->nullable();
            $table->tinyInteger('lockStatus')->comment('车锁状态，1可使用2故障中3共享中')->nullable();
            $table->string('start_time')->comment('共享开始时间')->nullable();
            $table->string('end_time')->comment('共享结束时间')->nullable();
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
        Schema::dropIfExists('agent_audit_other');
    }
}
