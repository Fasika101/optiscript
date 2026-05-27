<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->date('prescription_date');

            // Right Eye (OD - Oculus Dexter)
            $table->decimal('od_sphere', 5, 2)->nullable();
            $table->decimal('od_cylinder', 5, 2)->nullable();
            $table->integer('od_axis')->nullable();
            $table->decimal('od_add', 5, 2)->nullable();
            $table->string('od_va')->nullable();
            $table->decimal('od_prism', 5, 2)->nullable();
            $table->string('od_base')->nullable();

            // Left Eye (OS - Oculus Sinister)
            $table->decimal('os_sphere', 5, 2)->nullable();
            $table->decimal('os_cylinder', 5, 2)->nullable();
            $table->integer('os_axis')->nullable();
            $table->decimal('os_add', 5, 2)->nullable();
            $table->string('os_va')->nullable();
            $table->decimal('os_prism', 5, 2)->nullable();
            $table->string('os_base')->nullable();

            // Pupillary Distance
            $table->decimal('pd_far', 5, 1)->nullable();
            $table->decimal('pd_near', 5, 1)->nullable();
            $table->decimal('pd_right', 5, 1)->nullable();
            $table->decimal('pd_left', 5, 1)->nullable();

            // Diagnosis & Notes
            $table->string('diagnosis')->nullable();
            $table->enum('lens_type', ['single_vision', 'bifocal', 'progressive', 'contact_lens', 'reading_glasses'])->nullable();
            $table->text('recommendation')->nullable();
            $table->text('notes')->nullable();
            $table->date('next_visit')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
