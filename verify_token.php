<?php
    header('Content-Type: application/json');
    require __DIR__ .'/../vendor/autoload.php';

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\Auth\UserRecord;

    $serviceAccountPath = '' ;
    $factory = (new Factory)
        ->withServiceAccount($serviceAccountPath);

    $auth = $factory->createAuth();

    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['idToken']) && is_string($input['idToken']) && !empty($input['idToken'])) 
    {
        $idTokenString = $input['idToken'];

        try {
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);

            $uid = $verifiedIdToken->claims()->get('sub');
            $user = $auth->getUser($uid);

            $email = $user->email;
            $name = $user->displayName;
            $photoURL = $user->photoUrl;

            session_start();
            session_regenerate_id(true); // prevent session fixation
            $_SESSION['uid'] = $uid;
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['photoURL'] = $photoURL;
            
            echo json_encode(['success' => true]);

        } 
        catch (\Kreait\Firebase\Exception\Auth\InvalidIdToken $e) {
            error_log("Firebase InvalidIdToken: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Invalid token: ' . $e->getMessage()]);
        } 
        catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            error_log("Firebase UserNotFound: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'User not found: ' . $e->getMessage()]);
        } 
        catch (Exception $e) {
            error_log("Firebase General Error: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'General error:' . $e->getMessage()]);
        }

    }
    else {
        error_log("Missing or invalid idToken");
        echo json_encode(['success' => false, 'error' => 'Invalid request: idToken is missing or invalid']);
    }
?>