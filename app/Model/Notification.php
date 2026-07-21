<?php
App::uses('AppModel', 'Model');

class Notification extends AppModel
{
    public $belongsTo = array(
        'User' => array(
            'className'  => 'User',
            'foreignKey' => 'user_id'
        ),
        'Sender' => array(
            'className'  => 'User',
            'foreignKey' => 'user1_id'
        )
    );
}
