var reg;
var sub;
var isSubscribed = false;
var subscribeButton = document.querySelector('button');

if ('serviceWorker' in navigator) {
  console.log('Service Worker is supported'); 
  navigator.serviceWorker.register('sw.js').then(function() {
    return navigator.serviceWorker.ready;
  }).then(function(serviceWorkerRegistration) {
    reg = serviceWorkerRegistration;
    subscribeButton.disabled = false;
    subscribe();
    console.log('Service Worker is ready :^)', reg); 
  }).catch(function(error) {
    console.log('Service Worker Error :^(', error);
  }); 
}

subscribeButton.addEventListener('click', function() {
  if (isSubscribed) {
    console.log('unsubscribe');
    unsubscribe();
  } else {
    console.log('Subscribe');
    subscribe();
  }
});

function subscribe() {
  reg.pushManager.subscribe({userVisibleOnly: true}).
  then(function(pushSubscription){
    sub = pushSubscription;
    console.log('Subscribed! Endpoint:', sub.endpoint);

    addUser(sub.endpoint);

    subscribeButton.textContent = 'Unsubscribe';
    isSubscribed = true;
  });
}

function unsubscribe() {
  sub.unsubscribe().then(function(event) {
    subscribeButton.textContent = 'Subscribe';
    console.log('Unsubscribed!', event);
    isSubscribed = false;
  }).catch(function(error) {
    console.log('Error unsubscribing', error);
    subscribeButton.textContent = 'Subscribe';
  });
} 

function addUser(endpoint){
  var endpoint = endpoint.split('/');
  var i = (endpoint.length-1 );

  endpoint = endpoint[i];

  if(endpoint != ''){
    
    $.post('actions.php', {endpoint : endpoint, 'act' : 'add-user'}, function(r){
      if(r.res == 1){
        console.log('usuario foi adicionado!');
      }else{ console.log('Ocorreu algum erro ao adicionar usuario'); }
    }, 'json');

  }
}