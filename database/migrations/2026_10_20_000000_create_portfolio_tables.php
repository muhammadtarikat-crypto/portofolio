<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Biodata utama (hanya 1 baris)
        Schema::create('profiles', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('headline');
            $t->text('bio');
            $t->string('photo');
            $t->string('email');
            $t->string('github')->nullable();
            $t->string('linkedin')->nullable();
            $t->string('instagram')->nullable();
            $t->string('cv_url')->nullable();
            $t->timestamps();
        });

        Schema::create('skills', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('category');          // Frontend / Backend & Database / Tools
            $t->string('icon');              // URL ikon SVG
            $t->unsignedSmallInteger('sort')->default(0);
            $t->timestamps();
        });

        Schema::create('projects', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->string('category');          // web / mobile / design
            $t->text('description');
            $t->string('image');
            $t->json('tags');
            $t->string('demo_url')->nullable();
            $t->string('repo_url')->nullable();
            $t->unsignedSmallInteger('sort')->default(0);
            $t->timestamps();
        });

        Schema::create('experiences', function (Blueprint $t) {
            $t->id();
            $t->string('type');              // education / experience
            $t->string('title');
            $t->string('institution');
            $t->string('period');
            $t->json('details')->nullable();
            $t->unsignedSmallInteger('sort')->default(0);
            $t->timestamps();
        });

        Schema::create('certificates', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('issuer');
            $t->string('year', 10);
            $t->unsignedSmallInteger('sort')->default(0);
            $t->timestamps();
        });

        // Pesan dari form kontak
        Schema::create('contacts', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('email');
            $t->string('subject');
            $t->text('message');
            $t->timestamps();
        });
    }

    public function down(): void
    {
        foreach (['contacts', 'certificates', 'experiences', 'projects', 'skills', 'profiles'] as $table) {
            Schema::dropIfExists($table);
        }
    }
};
