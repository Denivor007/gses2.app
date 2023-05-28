<?php

namespace App\Service;

class EmailService
{

    private string $filepath = "D:\Учёба\PHP\caseKMAnGN\storage\EmailStorage.csv";


    public function isEmailInDB(String $email): bool
    {
        if (!file_exists($this -> filepath))
            return false;

        $data = fopen($this->filepath, 'r');
        while (($dbEmail = fgetcsv($data)) !== false) {
            if (trim($dbEmail[0]) == trim($email))
                return true;
        }
        fclose($data);

        return false;

    }

    public function putEmailIntoDb(String $email): void
    {
        if (!file_exists($this -> filepath))
            file_put_contents($this -> filepath, '');
        if (($data = fopen($this -> filepath, 'a' )) !== false) {
            fputcsv($data, [$email]);
        }
        fclose($data);
    }

    public function getAllEmails(){
        $array = [];
        if (($handle = fopen($this -> filepath, 'r')) !== false) {
            while (($email = fgetcsv($handle)) !== false) {
                $array[] = $email;
            }
            fclose($handle);
        }
         return $array;
    }



}
