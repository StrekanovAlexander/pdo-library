<?php

namespace App;

use \App\User;

class UserMapper
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(User $user)
    {
        $stmtUser = $this->pdo->prepare("INSERT INTO users (name) VALUES (?)");
        $stmtUser->execute([$user->getName()]);
        $user->setId($this->pdo->lastInsertId());

        // BEGIN (write your solution here)
        $photos = $user->getPhotos();
        foreach($photos as $photo) {
            $stmtPhoto = $this->pdo->prepare("INSERT INTO user_photos (user_id, name, filepath) VALUES (?, ?, ?)");
            $stmtPhoto->execute([$user->getId(), $photo->getName(), $photo->getFilepath()]);
        }
        // END
    }
}
