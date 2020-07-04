<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('field');
            $table->foreignId('user_id'); // Essentially the Resource Owner.
            $table->foreignId('entity_id'); // Resource needs to be assigned to Entity.
            $table->timestamps();
        });

        Schema::create('resource_user', function (Blueprint $table) {
            $table->primary(['user_id', 'resource_id']);

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('resource_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('resource_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_user');
        Schema::dropIfExists('resources');
    }
}
