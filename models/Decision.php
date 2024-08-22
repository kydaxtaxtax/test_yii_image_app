<?php
namespace app\models;

use yii\db\ActiveRecord;

class Decision extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'decisions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id', 'decision'], 'required'],
            ['image_id', 'integer'],
            ['decision', 'string', 'max' => 10],
            ['decision', 'in', 'range' => ['approved', 'rejected']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), ['image_id', 'decision']);
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return array_merge(parent::scenarios(), [
            self::SCENARIO_DEFAULT => ['image_id', 'decision'],
        ]);
    }
}
