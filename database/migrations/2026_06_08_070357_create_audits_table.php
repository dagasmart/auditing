<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection;

    private string $name = 'audits';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        ! Schema::hasTable($this->name)
        && Schema::create($this->name, function (Blueprint $table) {
            $morphPrefix = 'user';

            $table->comment('模型事件审计表');

            $table->bigIncrements('id');
            $table->string($morphPrefix.'_type')->nullable()->comment('用户类型');
            $table->unsignedBigInteger($morphPrefix.'_id')->nullable()->comment('用户id');
            $table->string('event')->comment('行为事件');
            $table->string('auditable')->comment('模型主键id');
            $table->text('old_values')->nullable()->comment('旧数据');
            $table->text('new_values')->nullable()->comment('新数据');
            $table->text('url')->nullable()->comment('url');
            $table->ipAddress('ip_address')->nullable()->comment('ip');
            $table->string($morphPrefix.'_agent', 1023)->nullable()->comment('用户代理');
            $table->string('tags')->nullable()->comment('标签');
            $table->timestamps();

            $table->index([$morphPrefix.'_id', $morphPrefix.'_type']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable($this->name)) {
            // 检查是否存在数据
            $exists = DB::table($this->name)->exists();
            // 不存在数据时，删除表
            if (! $exists) {
                // 删除 reverse
                Schema::dropIfExists($this->name);
            }
        }
    }
};
