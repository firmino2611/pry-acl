<?php

use Illuminate\Config\Repository;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * @var Repository
     */
    private $prefix;
    private $user_table;

    public function __construct() {
        $this->prefix = config('acl.table_prefix');
        $this->user_table = config('acl.table_users');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->prefix . 'role_' . $this->user_table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('role_id')
                ->references('id')
                ->on($this->prefix . 'roles')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on($this->user_table)
                ->onDelete('cascade');

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
        Schema::dropIfExists($this->prefix .'role_user');
    }
}
