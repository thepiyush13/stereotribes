<?php


/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property string $title
 * @property string $short_summary
 * @property string $country
 * @property string $city
 * @property string $flip_image_url
 * @property string $short_url
 * @property string $category
 * @property string $goal
 * @property string $currency
 * @property string $project_for
 * @property string $funding_type
 * @property integer $days_run
 * @property string $end_date
 * @property string $payment_date
 * @property integer $percent_funded
 * @property string $media_type
 * @property string $video_url
 * @property string $image_url
 * @property string $pitch_story
 * @property string $main_link
 * @property string $thankyou_media_type
 * @property string $thankyou_video_url
 * @property string $thankyou_image_url
 * @property string $share_url
 * @property string $publish_status
 * @property string $project_status
 * @property integer $featured
 * @property integer $public
 * @property integer $social_amplifier_status
 * @property string $tracker_code
 * @property string $reward_disclaimer
 * @property string $payment_type
 * @property integer $remember_me
 * @property string $promotion_method
 * @property integer $user_id
 * @property string $status
 * @property string $project_live_date
 *
 * The followings are the available model relations:
 * @property Links[] $links
 * @property MediaLinks[] $mediaLinks
 * @property User $user
 * @property Reward[] $rewards
 * @property SocialAmplifier[] $socialAmplifiers
 * @property Tribes[] $tribes
 * @property UserFundProject[] $userFundProjects
 */
class Project extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reward_disclaimer, payment_type, remember_me, promotion_method', 'required'),
			array('days_run, percent_funded, featured, public, social_amplifier_status, remember_me, user_id', 'numerical', 'integerOnly'=>true),
			array('title, short_url, category, payment_type, promotion_method, status', 'length', 'max'=>55),
			array('short_summary, flip_image_url, thankyou_video_url, thankyou_image_url, share_url', 'length', 'max'=>255),
			array('country, city, video_url, image_url', 'length', 'max'=>100),
			array('goal, project_for', 'length', 'max'=>10),
			array('currency, media_type, thankyou_media_type, publish_status, project_status', 'length', 'max'=>45),
			array('funding_type', 'length', 'max'=>8),
			array('main_link', 'length', 'max'=>155),
			array('reward_disclaimer', 'length', 'max'=>3),
			array('end_date, payment_date, pitch_story, tracker_code, project_live_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, short_summary, country, city, flip_image_url, short_url, category, goal, currency, project_for, funding_type, days_run, end_date, payment_date, percent_funded, media_type, video_url, image_url, pitch_story, main_link, thankyou_media_type, thankyou_video_url, thankyou_image_url, share_url, publish_status, project_status, featured, public, social_amplifier_status, tracker_code, reward_disclaimer, payment_type, remember_me, promotion_method, user_id, status, project_live_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'links' => array(self::HAS_MANY, 'Links', 'project_id'),
			'mediaLinks' => array(self::HAS_MANY, 'MediaLinks', 'project_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'rewards' => array(self::HAS_MANY, 'Reward', 'project_id'),
			'socialAmplifiers' => array(self::HAS_MANY, 'SocialAmplifier', 'project_id'),
			'tribes' => array(self::HAS_MANY, 'Tribes', 'project_id'),
			'userFundProjects' => array(self::HAS_MANY, 'UserFundProject', 'project_id'),
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'short_summary' => 'Short Summary',
			'country' => 'Country',
			'city' => 'City',
			'flip_image_url' => 'Flip Image Url',
			'short_url' => 'Short Url',
			'category' => 'Category',
			'goal' => 'Goal',
			'currency' => 'Currency',
			'project_for' => 'Project For',
			'funding_type' => 'Funding Type',
			'days_run' => 'Days Run',
			'end_date' => 'End Date',
			'payment_date' => 'Payment Date',
			'percent_funded' => 'Percent Funded',
			'media_type' => 'Media Type',
			'video_url' => 'Video Url',
			'image_url' => 'Image Url',
			'pitch_story' => 'Pitch Story',
			'main_link' => 'Main Link',
			'thankyou_media_type' => 'Thankyou Media Type',
			'thankyou_video_url' => 'Thankyou Video Url',
			'thankyou_image_url' => 'Thankyou Image Url',
			'share_url' => 'Share Url',
			'publish_status' => 'Publish Status',
			'project_status' => 'Project Status',
			'featured' => 'Featured',
			'public' => 'Public',
			'social_amplifier_status' => 'Social Amplifier Status',
			'tracker_code' => 'Tracker Code',
			'reward_disclaimer' => 'Reward Disclaimer',
			'payment_type' => 'Payment Type',
			'remember_me' => 'Remember Me',
			'promotion_method' => 'Promotion Method',
			'user_id' => 'User',
			'status' => 'Status',
			'project_live_date' => 'Project Live Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_summary',$this->short_summary,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('flip_image_url',$this->flip_image_url,true);
		$criteria->compare('short_url',$this->short_url,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('goal',$this->goal,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('project_for',$this->project_for,true);
		$criteria->compare('funding_type',$this->funding_type,true);
		$criteria->compare('days_run',$this->days_run);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('percent_funded',$this->percent_funded);
		$criteria->compare('media_type',$this->media_type,true);
		$criteria->compare('video_url',$this->video_url,true);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('pitch_story',$this->pitch_story,true);
		$criteria->compare('main_link',$this->main_link,true);
		$criteria->compare('thankyou_media_type',$this->thankyou_media_type,true);
		$criteria->compare('thankyou_video_url',$this->thankyou_video_url,true);
		$criteria->compare('thankyou_image_url',$this->thankyou_image_url,true);
		$criteria->compare('share_url',$this->share_url,true);
		$criteria->compare('publish_status',$this->publish_status,true);
		$criteria->compare('project_status',$this->project_status,true);
		$criteria->compare('featured',$this->featured);
		$criteria->compare('public',$this->public);
		$criteria->compare('social_amplifier_status',$this->social_amplifier_status);
		$criteria->compare('tracker_code',$this->tracker_code,true);
		$criteria->compare('reward_disclaimer',$this->reward_disclaimer,true);
		$criteria->compare('payment_type',$this->payment_type,true);
		$criteria->compare('remember_me',$this->remember_me);
		$criteria->compare('promotion_method',$this->promotion_method,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('project_live_date',$this->project_live_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function behaviors() {
        return array(
            'commentable' => array(
                'class' => 'ext.comment-module.behaviors.CommentableBehavior',
                // name of the table created in last step
                'mapTable' => 'posts_comments_nm',
                // name of column to related model id in mapTable
                'mapRelatedColumn' => 'postId'
            ),
       );
    }
}
