<?php
use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('/config/firebase_credentials.json');

$firestore = $factory->createFirestore();