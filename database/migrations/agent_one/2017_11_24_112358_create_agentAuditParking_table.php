<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentAuditParkingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_audit_parking',function(Blueprint $table){
            $table->integer('auditId')->comment('审核ID，外键');
            $table->string('tradeArea', 20)->comment('商圈')->nullable();
            $table->integer('rated_total')->comment('车位总数')->nullable();//1000
            $table->integer('parking_total')->comment('可用总数')->nullable();//0-1000
            $table->integer('rated_place_number')->comment('共享总数')->nullable();//800
            $table->integer('parking_available')->comment('共享可用数')->nullable();//0-800
            $table->tinyInteger('remoteControl')->comment('1是,2否,是否需要为该停车场配备门闸遥控')->nullable();
            $table->decimal('price',8,2)->comment('车位价格')->nullable();
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
        Schema::dropIfExists('agent_audit_parking');
    }
}
