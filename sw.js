'use strict';

var url;
console.log('Started', self);

self.addEventListener('install', function(event) {
  self.skipWaiting();
  //console.log('Installed', event);
});

self.addEventListener('activate', function(event) {
  //console.log('Activated', event);
});

self.addEventListener('message', function(event){
   // console.log("SW Received MessageX: " + event.data);
    sendPush(event.data.title, event.data.msg, event.data.link);
    // console.log(event.data.link);
    url = event.data.link;
});
 
self.addEventListener('notificationclick', function(event) {
    console.log('Notification click: tag ', event.notification.tag);
 
   event.notification.close();

    //var url = url;
    event.waitUntil(
        clients.matchAll({
            type: 'window'
        })
        .then(function(windowClients) {
            for (var i = 0; i < windowClients.length; i++) {
                var client = windowClients[i];
                if (client.url === url && 'focus' in client) {
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(url);
            }
        })
    );
});

function sendPush(title, msg, link){
	self.addEventListener('push', function(event) {
		console.log('Push message', event);
		  
		event.waitUntil(
	    self.registration.showNotification(title, {
	      body: msg,
	      icon: 'images/icon.png',
	      tag: ''+link+''
	    }));
	});
}

