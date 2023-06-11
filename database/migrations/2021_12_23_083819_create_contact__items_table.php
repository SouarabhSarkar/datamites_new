<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact__items', function (Blueprint $table) {
            $table->id();
            $table->integer('belongs_to')->default(null)->nullable();
            $table->enum('contact_item_type',['email','phone','driver_license_number','doctors_license','aadhar_card','pan_card','address']);
            $table->string('value');
            $table->enum('status',['on','off'])->nullable();
            $table->datetime('verified_on')->nullable();
            $table->enum('verification_status',['verified','not_verified','claim_released'])->nullable();
            $table->string('verification_code')->nullable();
            $table->datetime('released_on')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('contact__items');
    }
}
