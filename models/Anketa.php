<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "anketa".
 *
 * @property int $id
 * @property int|null $age_and_education_id
 * @property string|null $place_of_residence
 * @property int|null $main_occupation_id
 * @property int|null $knowledge_level_id
 * @property string|null $cv_writing_skills
 * @property string|null $computer_skills
 * @property string|null $how_often_see_doctor
 * @property string|null $play_sports
 * @property string|null $improve_qualifications
 * @property string|null $change_profession
 * @property string|null $search_training_courses
 * @property string|null $taken_edu_courses
 * @property string|null $life_skills
 * @property string|null $family_conditions
 * @property string|null $famali_depends
 * @property int|null $course_to_like_attend_id
 * @property int|null $go_to_take_course_id
 * @property int|null $most_important_for_checking_course_id
 * @property string|null $attend_paid_courses
 * @property int|null $time_attend_courses_id
 * @property int|null $type_search_courses_id
 * @property string|null $wishes_suggestions
 */
class Anketa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anketa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['age_and_education_id', 'main_occupation_id', 'knowledge_level_id', 'course_to_like_attend_id', 'go_to_take_course_id', 'most_important_for_checking_course_id', 'time_attend_courses_id', 'type_search_courses_id'], 'integer'],
            [['cv_writing_skills', 'computer_skills', 'play_sports', 'improve_qualifications', 'change_profession', 'search_training_courses', 'taken_edu_courses', 'life_skills', 'family_conditions', 'attend_paid_courses', 'wishes_suggestions'], 'string'],
            [['place_of_residence', 'how_often_see_doctor', 'famali_depends'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'age_and_education_id' => '1. Ваш возраст и Ваше образование',
            'place_of_residence' => '2. Место проживания? (город, район, джамоат)',
            'main_occupation_id' => '3. Каково Ваше основное занятие в настоящий момент? (выберите один ответ)',
            'knowledge_level_id' => '4. Достаточно ли ваших знаний для выполнения качественной профессиональной деятельности? ',
            'cv_writing_skills' => '5. Есть ли у Вас навыки по написанию CV (Резюме)?',
            'computer_skills' => '6. Имеете ли Вы навыки работы на компьютере?',
            'how_often_see_doctor' => '7. Как часто Вы обращаетесь к врачам?',
            'play_sports' => '8. Занимаетесь ли Вы спортом?',
            'improve_qualifications' => '9. Хотите ли Вы повысить свою квалификацию?',
            'change_profession' => '10. Хотели бы Вы изменить свою профессию?',
            'search_training_courses' => '11. Занимались ли Вы поиском обучаемых курсов?',
            'taken_edu_courses' => '12. Вы проходили образовательные курсы?',
            'life_skills' => '13. Какие жизненные навыки Вами востребованы в Вашей работе?',
            'family_conditions' => '14. Какие жизненные навыки Вами востребованы в Вашей работе?',
            'famali_depends' => '15. Как Вы думаете, от чего зависит благополучие семьи?',
            'course_to_like_attend_id' => '16. Какие курсы хотели бы Вы посещать?',
            'go_to_take_course_id' => '17. Куда Вы обратитесь для прохождения курсов?',
            'most_important_for_checking_course_id' => '18. Что наиболее важно для Вас при выборе обучения?',
            'attend_paid_courses' => '19. Имеете ли Вы возможность посещать платные курсы? ',
            'time_attend_courses_id' => '20. В какое время Вы можете посещать курсы? ',
            'type_search_courses_id' => '21. Как Вы будете искать курсы для посещения?',
            'wishes_suggestions' => 'Ваши пожелания и предложения:',
        ];
    }
}
