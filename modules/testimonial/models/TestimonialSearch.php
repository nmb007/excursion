<?php
namespace app\modules\testimonial\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * TestimonialSearch represents the model behind the search form about `app\models\Testimonial`.
 */
class TestimonialSearch extends Testimonial
{
    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'safe'],
        ];
    }

    /**
     * Returns a list of scenarios and the corresponding active attributes.
     *
     * @return array
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array   $params
     * @param integer $pageSize  The number of results to be displayed per page.
     * @param boolean $published Whether or not testimonials have to be published.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $pageSize = 3)
    {
        $query = Testimonial::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSize' => $pageSize,
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);
        return $dataProvider;
    }
}
