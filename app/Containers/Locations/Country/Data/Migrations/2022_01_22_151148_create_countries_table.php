<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCountriesTable
 */
class CreateCountriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up(): void
    {
        Schema::create(config('locations-country.table.name'), function (Blueprint $table) {
            $table->id();
            $table->string('name', config('locations-country.table.name_max_length'))->unique();
            $table->text('params')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('locations-country.table.name'));
    }
}
