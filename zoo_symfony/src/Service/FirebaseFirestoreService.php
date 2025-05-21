<?php
namespace App\Service;

use Google\Cloud\Firestore\FirestoreClient;

class FirebaseFirestoreService
{
    private FirestoreClient $firestore;

    public function __construct()
    {
        $this->firestore = new FirestoreClient([
            'keyFilePath' => __DIR__ . '/../../config/firebase_credentials.json',
            'projectId' => 'zoo-project-baa39'
        ]);


        
    }

    public function getCollection(string $name)
    {
        return $this->firestore->collection($name)->documents();
    }

    public function addDocument(string $collection, array $data)
    {
        return $this->firestore->collection($collection)->add($data);
    }

    public function getDocument(string $collection, string $id)
    {
        return $this->firestore->collection($collection)->document($id)->snapshot();
    }

    public function logLogin(array $data): void
    {

        $this->firestore->collection('login_logs')->add($data);
    }




}
