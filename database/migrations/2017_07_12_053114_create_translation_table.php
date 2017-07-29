<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Logic\TranslationRepostory;

class CreateTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translation', function (Blueprint $table) {
            $table->increments('id_num');
            $table->string('caller')->nullable()->unique();
            $table->text('zh-cn')->nullable()->comment('官話 / 普通话');     // Chinese
            $table->text('es')->nullable()->comment('Español');             // Spanish
            $table->text('en')->nullable()->comment('English');             // English
            $table->text('hi')->nullable()->comment('हिन्दी');              // Hindi
            $table->text('ar')->nullable()->comment('العربيَّة');             // Arabic
            $table->text('pt')->nullable()->comment('Português');           // Portuguese
            $table->text('bn')->nullable()->comment('বাংলা');              // Bengali
            $table->text('ru')->nullable()->comment('Русский');             // Russian
            $table->text('ja')->nullable()->comment('日本語');               // Japanese
            $table->text('pa')->nullable()->comment('ਪੰਜਾਬੀ');              // Punjabi
            $table->text('de')->nullable()->comment('Deutsch');             // German
            $table->text('id')->nullable()->comment('Basa Jawa');           // Javanese
            $table->text('fr')->nullable()->comment('Français');            // French
            $table->text('fa')->nullable()->comment('فارسی');                // Persian
            $table->text('tr')->nullable()->comment('Türkçe');              // Turkish
            $table->text('th')->nullable()->comment('ภาษาไทย');               // Thai
            $table->text('nl')->nullable()->comment('Nederlands');          // Dutch
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $translationRepostory = new TranslationRepostory;

        if($translationRepostory->storeData())
            Schema::drop('translation');
    }
}
