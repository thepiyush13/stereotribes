<?php

/**
 * This is the model class for table "newsletter".
 *
 * The followings are the available columns in table 'newsletter':
 * @property string $id
 * @property string $subject
 * @property string $html_body
 * @property string $text_body
 * @property string $misc
 * @property integer $status
 * @property string $updated
 * @property string $created
 */
class Newsletter extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'newsletter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('status', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>250),
                    array('subject', 'required'),
			array('misc', 'length', 'max'=>20),
			array('html_body, text_body, created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, subject, html_body, text_body, misc, status, updated, created', 'safe', 'on'=>'search'),
                    array('updated','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'update'),        array('created,updated','default',
              'value'=>new CDbExpression('NOW()'),              'setOnEmpty'=>false,'on'=>'insert'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subject' => 'Subject',
			'html_body' => 'Html Body',
			'text_body' => 'Text Body',
			'misc' => 'Misc',
			'status' => 'Status',
			'updated' => 'Updated',
			'created' => 'Created',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('html_body',$this->html_body,true);
		$criteria->compare('text_body',$this->text_body,true);
		$criteria->compare('misc',$this->misc,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Newsletter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
