<?php

namespace Controllers;

use Library;
use Managers;
use Entities;

class AdminController extends Library\View
{

    private function security()
    {
        if ($this->session->get('login')) {
            $userManager = new Managers\UserManager();
            $user = $userManager->get($this->session->get('login'));
            if ($user->getLevel() == 0) $this->route->redirect('404');
            else {
                $userManager = new Managers\UserManager();
                $user = $userManager->get($user->getId());
                $this->setData('user', $user);
                return true;
            }
        } else {
            $this->route->redirect('404');
        }
    }

    public function default()
    {
        $this->security();
        $userManager = new Managers\UserManager();
        $postManager = new Managers\PostManager();
        $blogposts = $postManager->getAll();
        $this->setData('blogposts', $blogposts);
        $this->setData('userManager', $userManager);
        $this->render('admin/blogposts', 'admin');
    }

    public function blogposts()
    {
        $this->default();
    }
}
