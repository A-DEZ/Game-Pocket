<?php

namespace App\Controller;

class FormController extends AbstractController
{
    public function form()
    {
        return $this->twig->render('Form/contactForm.html.twig');
    }
}
