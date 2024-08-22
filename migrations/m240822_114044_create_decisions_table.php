<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%decisions}}`.
 */
class m240822_114044_create_decisions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%decisions}}', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer()->notNull(), // ID изображения
            'decision' => $this->string(10)->notNull(), // Решение: approved или rejected
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
            'updated_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
        ]);

        // Добавляем функцию для обновления updated_at
        $this->execute("
            CREATE OR REPLACE FUNCTION update_updated_at_column()
            RETURNS TRIGGER AS
            $$
            BEGIN
                NEW.updated_at = CURRENT_TIMESTAMP;
                RETURN NEW;
            END;
            $$
            LANGUAGE plpgsql;
        ");

        // Добавляем триггер для автоматического обновления updated_at
        $this->execute("
            CREATE TRIGGER trigger_update_updated_at
            BEFORE UPDATE ON decisions
            FOR EACH ROW
            EXECUTE FUNCTION update_updated_at_column();
        ");

        // Добавляем индекс на поле image_id для повышения производительности
        $this->createIndex(
            '{{%idx-decisions-image_id}}',
            '{{%decisions}}',
            'image_id'
        );

        // Добавляем индекс на поле decision для повышения производительности
        $this->createIndex(
            '{{%idx-decisions-decision}}',
            '{{%decisions}}',
            'decision'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("DROP TRIGGER IF EXISTS trigger_update_updated_at ON decisions;");
        $this->execute("DROP FUNCTION IF EXISTS update_updated_at_column;");

        $this->dropTable('{{%decisions}}');
    }
}
