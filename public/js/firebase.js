/* The core Firebase JS SDK is always required and must be listed first
<script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-app.js"></script>*/


// importScripts('https://www.gstatic.com/firebasejs/8.1.1/firebase-app.js');
// // importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js');
// importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js');

/* TODO: Add SDKs for Firebase products that you want to use
https://firebase.google.com/docs/web/setup#available-libraries */

// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyCFos_kBExAr3ZAhEoh5ga45LwJNKVkzBs",
    authDomain: "voluntary-programs.firebaseapp.com",
    databaseURL: "https://voluntary-programs.firebaseio.com",
    projectId: "voluntary-programs",
    storageBucket: "voluntary-programs.appspot.com",
    messagingSenderId: "862334564636",
    appId: "1:862334564636:web:3fec5651ab3cae22e1a2d9"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
// firebase.initializeApp(
//     {
//         apiKey: "AIzaSyCFos_kBExAr3ZAhEoh5ga45LwJNKVkzBs",
//         authDomain: "voluntary-programs.firebaseapp.com",
//         databaseURL: "https://voluntary-programs.firebaseio.com",
//         projectId: "voluntary-programs",
//         storageBucket: "voluntary-programs.appspot.com",
//         messagingSenderId: "862334564636",
//         appId: "1:862334564636:web:3fec5651ab3cae22e1a2d9"
//     }
// );

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
// messaging.setBackgroundMessageHandler(function(payload) {
//     console.log('[firebase-messaging-sw.js] Received background message ', payload);
//     // Customize notification here
//     const notificationTitle = 'Background Message Title';
//     const notificationOptions = {
//         body: 'Background Message body.',
//         icon: '/firebase-logo.png'
//     };
//
//     return self.registration.showNotification(notificationTitle,
//         notificationOptions);
// });
messaging.requestPermission().then(function (){
    console.log("Notification Permission granted")
    return messaging.getToken()
}).then(function (token) {
    console.log(token)
}).catch(function (err) {
    console.log("Enable to get permission to notify".err)
});
