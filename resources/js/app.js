import './bootstrap'; 
import 'laravel-datatables-vite';

window.Echo.channel('chat')
    .listen('.message',(e)=>{
      alert('hi');
    });