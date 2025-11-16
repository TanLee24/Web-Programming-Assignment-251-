<?php

//require_once '../app/models/Contact.php';
require_once APPROOT . '/models/Contact.php';


class ContactController
{
    public function form()
    {
        $data = ['title' => 'Liên hệ'];
        require '../app/views/layouts/main.php';
    }

    public function submit()
    {
        $contactModel = new Contact;

        $data = [
            'full_name' => $_POST['full_name'],
            'email' => $_POST['email'],
            'message' => $_POST['message']
        ];

        $contactModel->save($data);

        header("Location: " . URLROOT . "/public/index.php?url=pages/contact&success=1");
        exit;
    }
}
