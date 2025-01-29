<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBlogIdToCommentsTable extends Migration
{
    /**
     * 在 comments 表中新增 blog_id 欄位
     *
     * @return void
     */
 public function up()
{
    Schema::table('comments', function (Blueprint $table) {
        if (!Schema::hasColumn('comments', 'user_id')) {
            $table->unsignedBigInteger('user_id')->after('content');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        }
    });
}


    /**
     * 回滾遷移
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            // 刪除外鍵約束，可選
            $table->dropForeign(['blog_id']);
            // 移除 blog_id 欄位
            $table->dropColumn('blog_id');
        });
    }
}

