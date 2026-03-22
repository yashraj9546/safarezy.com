function signInWithGoogle() {
    const provider = new firebase.auth.GoogleAuthProvider();
    auth.signInWithPopup(provider)
      .then((result) => {
        const user = result.user;
        user.getIdToken().then((idToken) => {
          sendTokenToServer(idToken); // Send the ID token to your PHP server
        });
      })
      .catch((error) => {
        console.error("Google Sign-In Error:", error);
      });
}
  
function sendTokenToServer(idToken){
     
    fetch('verify_token.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({idToken: idToken})
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            console.log("Token Verified");
            //Proceed with your application logic, store user info.
            window.location.reload();
        } else {
            console.error("Token verification failed");
        }
    })
    .catch(error => {
        console.error("Error sending token: ", error);
    })
}

function signOut() {
    auth.signOut().then(() => {
        console.log('User signed out.');
        // Optionally redirect or update UI
        fetch('logout.php') //tell the server to clear sessions.
        .then(response => response.json())
        .then(data=>{
            if(data.success){
                console.log("Session cleared on server");
            }
            else{
                console.log("error clearing session on server");
            }
        })
        .catch(error=>{
            console.log("error communicating with logout.php");
        });

    }).catch((error) => {
        console.error('Sign out error:', error);
    });
}