<?php

use yii\db\Migration;

class m170804_133419_math extends Migration
{
    /**
     * Added Below columns to achieve desired result
     *
     * answer | User inputted answer
     * ip | IP address of the user
     * unique_id | Is generated per exam taken
     * created_at | When the result was saved to DB
     *
     */
    public function up()
    {
        if (empty($this->db->getTableSchema('{{%math}}'))) {
            $this->createTable(
                '{{%math}}',
                [
                    'id' => $this->primaryKey(),
                    'task' => $this->string(),
                    'result' => $this->float(),
                    'answer' => $this->float(),
                    'ip' => $this->string(100)->notNull(),
                    'unique_id' => $this->string(100)->notNull(),
                    'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                ]
            );
        }
    }

    public function down()
    {
        if (!empty($this->db->getTableSchema('{{%math}}'))) {
            $this->dropTable('{{%math}}');
        }
    }
}
