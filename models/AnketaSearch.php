<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Anketa;

/**
 * AnketaSearch represents the model behind the search form of `app\models\Anketa`.
 */
class AnketaSearch extends Anketa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'age_and_education_id', 'main_occupation_id', 'knowledge_level_id', 'course_to_like_attend_id', 'go_to_take_course_id', 'most_important_for_checking_course_id', 'time_attend_courses_id', 'type_search_courses_id'], 'integer'],
            [['place_of_residence', 'cv_writing_skills', 'computer_skills', 'how_often_see_doctor', 'play_sports', 'improve_qualifications', 'change_profession', 'search_training_courses', 'taken_edu_courses', 'life_skills', 'family_conditions', 'famali_depends', 'attend_paid_courses', 'wishes_suggestions'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Anketa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'age_and_education_id' => $this->age_and_education_id,
            'main_occupation_id' => $this->main_occupation_id,
            'knowledge_level_id' => $this->knowledge_level_id,
            'course_to_like_attend_id' => $this->course_to_like_attend_id,
            'go_to_take_course_id' => $this->go_to_take_course_id,
            'most_important_for_checking_course_id' => $this->most_important_for_checking_course_id,
            'time_attend_courses_id' => $this->time_attend_courses_id,
            'type_search_courses_id' => $this->type_search_courses_id,
        ]);

        $query->andFilterWhere(['like', 'place_of_residence', $this->place_of_residence])
            ->andFilterWhere(['like', 'cv_writing_skills', $this->cv_writing_skills])
            ->andFilterWhere(['like', 'computer_skills', $this->computer_skills])
            ->andFilterWhere(['like', 'how_often_see_doctor', $this->how_often_see_doctor])
            ->andFilterWhere(['like', 'play_sports', $this->play_sports])
            ->andFilterWhere(['like', 'improve_qualifications', $this->improve_qualifications])
            ->andFilterWhere(['like', 'change_profession', $this->change_profession])
            ->andFilterWhere(['like', 'search_training_courses', $this->search_training_courses])
            ->andFilterWhere(['like', 'taken_edu_courses', $this->taken_edu_courses])
            ->andFilterWhere(['like', 'life_skills', $this->life_skills])
            ->andFilterWhere(['like', 'family_conditions', $this->family_conditions])
            ->andFilterWhere(['like', 'famali_depends', $this->famali_depends])
            ->andFilterWhere(['like', 'attend_paid_courses', $this->attend_paid_courses])
            ->andFilterWhere(['like', 'wishes_suggestions', $this->wishes_suggestions]);

        return $dataProvider;
    }
}
