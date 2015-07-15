<?php
namespace app\modules\post\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * PostSearch represents the model behind the search form about `app\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'type', 'created_at', 'updated_at'], 'integer'],
            [['title', 'content'], 'safe'],
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
     * @param boolean $published Whether or not posts have to be published.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $pageSize = 3, $published = false)
    {
        $query = Post::find();

        // this means that editor is trying to see posts
        // we will allow him to see published ones and drafts made by him
        if ($published === true) 
        {
            $query->where(['status' => Post::STATUS_PUBLISHED]);
            $query->orWhere(['user_id' => Yii::$app->user->id]);
        }

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
            'status' => $this->status,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
