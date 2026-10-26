<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Model BookCategory - bảng `book_categories` (Thể loại sách).
 *
 * @property string      $category_code Mã thể loại (khóa chính)
 * @property string      $category_name Tên thể loại
 * @property string|null $description   Mô tả
 */
class BookCategory extends ActiveRecord
{
    /** Khi sửa: không cho đổi mã thể loại (khóa chính). */
    public const SCENARIO_UPDATE = 'update';

    public static function tableName()
    {
        return 'book_categories';
    }

    public function rules()
    {
        return [
            // Chuẩn hóa dữ liệu nhập: mã viết hoa, bỏ khoảng trắng thừa
            ['category_code', 'filter', 'filter' => function ($value) {
                return is_string($value) ? mb_strtoupper(trim($value)) : $value;
            }],
            [['category_name', 'description'], 'trim'],
            ['description', 'default', 'value' => null],

            [['category_code', 'category_name'], 'required'],

            ['category_code', 'string', 'max' => 10],
            ['category_code', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/',
                'message' => 'Mã thể loại chỉ gồm chữ cái không dấu, chữ số, dấu gạch ngang (-) hoặc gạch dưới (_).'],
            ['category_code', 'unique', 'message' => 'Mã thể loại "{value}" đã tồn tại.'],

            ['category_name', 'string', 'max' => 100],
            ['category_name', 'unique', 'message' => 'Tên thể loại "{value}" đã tồn tại.'],

            ['description', 'string', 'max' => 255],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = ['category_name', 'description'];
        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'category_code' => 'Mã thể loại',
            'category_name' => 'Tên thể loại',
            'description' => 'Mô tả',
        ];
    }
}
