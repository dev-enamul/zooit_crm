import './bootstrap';

window.Echo.channel('chat')
    .listen('.message',(e)=>{
      alert('hi');
    });