<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Model tìm kiếm thể loại sách theo từ khóa (mã, tên hoặc mô tả).
 */
class BookCategorySearch extends Model
{
    public $keyword;

    public function rules()
    {
        return [
            ['keyword', 'trim'],
            ['keyword', 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return ['keyword' => 'Từ khóa'];
    }

    /**
     * @param array $params Tham số từ $_GET
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BookCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
            'sort' => [
                'defaultOrder' => ['category_code' => SORT_ASC],
                'attributes' => ['category_code', 'category_name'],
            ],
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['or',
            ['like', 'category_code', $this->keyword],
            ['like', 'category_name', $this->keyword],
            ['like', 'description', $this->keyword],
        ]);

        return $dataProvider;
    }
}
