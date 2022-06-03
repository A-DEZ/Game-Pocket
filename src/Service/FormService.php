<?php

namespace App\Service;

use DateTime;

class FormService
{
    private array $errors = [];
    private string $successForm = '';

    /**
     * @return string
     */
    public function getSuccessForm(): string
    {
        return $this->successForm;
    }

    /**
     * @param string $successForm
     */
    public function setSuccessForm(string $successForm): void
    {
        $this->successForm = $successForm;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }
    public function testInput($datas): string
    {
        $datas = trim($datas);
        $datas = stripslashes($datas);
        $datas = htmlspecialchars($datas);
        return $datas;
    }

    // Fonction validation du format de la date

    public function validateDate($date, $format = 'Y-m-d'): void
    {
        $correctDate = DateTime::createFromFormat($format, $date);
        if ($correctDate && $correctDate->format($format) !== $date) {
            $this->errors[] = "Your date must be in the YYYY-MM-DD format";
        }
    }

    public function emptyCheck(array $formData)
    {
        foreach ($formData as $field) {
            if (empty($_POST[$field])) {
                $this->errors[] = "Fields are required";
            }
        }
    }

    public function extensionCheck(string $extension): void
    {
        $authorizedExtensions = ['jpg', 'png', 'gif', 'jpeg', 'webp'];
        if ((!in_array($extension, $authorizedExtensions))) {
            $this->errors[] = "Only jpg, png, gif, jpeg or webp files";
        }
    }

    public function sizeCheck(string $file): void
    {
        $maxFileSize = 1000000;
        if (file_exists($file) && filesize($file) > $maxFileSize) {
            $this->errors[] = "Files not existing or too large max authorized : 1Mo";
        }
    }

    public function textCheck(string $text): void
    {
        if (!preg_match("/^[a-zA-Z0-9-' ]+$/", $text)) {
            $this->errors[] = "Only letters, numbers, '-' and white space allowed";
        }
    }

    public function urlCheck(string $url): void
    {
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)) {
            $this->errors[] = "Invalid URL";
        }
    }

    public function mailCheck(string $mail): void
    {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Invalid mail";
        }
    }

    public function success()
    {
        $this->successForm = "Ton jeu a bien été ajouté";
    }
}
