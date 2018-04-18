<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'agent_manage_users', function (Blueprint $table){
                $table->increments('id')->comment("tbase的代理商id 被动分配");
                $table->string('account', 20)->comment("账号id 被动分配");
                $table->string('password')->comment("密码");
                $table->string('roleName', 20)->comment("角色名称");
                $table->string('created_at')->nullable()->comment("创建时间");
                $table->string('updated_at')->nullable()->comment("更新时间");
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
        Schema::dropIfExists('agent_manage_users');
    }
}
