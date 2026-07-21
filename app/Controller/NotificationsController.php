<?php
App::uses('AppController', 'Controller');

class NotificationsController extends AppController
{
    public $uses = array('Notification');

    public function index()
    {
        $this->Notification->recursive = 0;
        $notifications = $this->Notification->find('all', array(
            'conditions' => array('Notification.user_id' => AuthComponent::user('id')),
            'order' => array('Notification.created' => 'DESC'),
            'limit' => 50
        ));

        // Get unread notification messages to update first reader
        $unreadMessages = array();
        foreach ($notifications as $notif) {
            if ($notif['Notification']['vue'] == 0 && !empty($notif['Notification']['message'])) {
                $unreadMessages[] = $notif['Notification']['message'];
            }
        }

        // If the current user is Admin, mark these as read by them first in DB (if not already set)
        if (!empty($unreadMessages) && AuthComponent::user('role') === 'Admin') {
            $adminName = AuthComponent::user('name');
            $currentTime = date('Y-m-d H:i:s');
            $db = $this->Notification->getDataSource();
            $escapedName = $db->value($adminName, 'string');
            $escapedTime = $db->value($currentTime, 'string');

            $this->Notification->updateAll(
                array(
                    'Notification.first_read_by' => $escapedName,
                    'Notification.first_read_at' => $escapedTime
                ),
                array(
                    'Notification.message' => $unreadMessages,
                    'Notification.first_read_by' => null
                )
            );

            // Reflect the first read by name and time in the current $notifications list in memory
            foreach ($notifications as $key => $notif) {
                if ($notif['Notification']['vue'] == 0 && empty($notif['Notification']['first_read_by'])) {
                    $notifications[$key]['Notification']['first_read_by'] = $adminName;
                    $notifications[$key]['Notification']['first_read_at'] = $currentTime;
                }
            }
        }

        // Mark all as read for the current user
        $this->Notification->updateAll(
            array('Notification.vue' => 1),
            array('Notification.user_id' => AuthComponent::user('id'), 'Notification.vue' => 0)
        );

        $this->set(compact('notifications'));
    }

    public function system_get_nombre_notification()
    {
        $this->autoRender = false;
        $this->Notification->recursive = -1;
        $count = $this->Notification->find('count', array(
            'conditions' => array(
                'Notification.user_id' => AuthComponent::user('id'),
                'Notification.vue' => 0
            )
        ));
        return $count > 0 ? $count : null;
    }
}
