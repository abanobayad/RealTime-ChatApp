import axios from 'axios';
import './bootstrap';

const messages_el = document.getElementById("messages");
const username_input = document.getElementById("username");
const auth_id = document.getElementById("auth_id");
const message_input = document.getElementById("message_input");
const message_form = document.getElementById("message_form");


//Send Message And Store it
message_form.addEventListener('submit' , function(e){
    e.preventDefault();

    let has_errors = false;

    if(message_input.value == '' )
    {
        console.log("Empty Message");
        alert('Please Enter Message');
        has_errors = true;
    }

    if (has_errors) {
        return;
    }

    const options = {
        method:'post',
        url : '/send-message',
        data : {
            username : username_input.value,
            message : message_input.value,
        }
    }

    axios(options);
    message_input.value = '';
});

//Response
window.Echo.channel('chat')
.listen('.message' , (e) => {
    console.log(e);
    console.log(auth_id.value);
    if (e.userid == auth_id.value) {
        messages_el.innerHTML += '<div class="my-3"><div class="row "><div class="col-3"><strong class="text-indigo">' + e.username  + ' : </strong></div><div class="col-6 py-1" style="background-color: rgb(148, 61, 230) ; color: white ; border-radius: 50px "><span  >'+ e.message+'</span></div><div class="col-3"><span class="m_time">' + e.message_time+'</span></div></div></div>';
    } else {
        messages_el.innerHTML +='<div class="my-3" ><div class="row "><div class="col-3"><span class="text-muted" style="font-size: 12px">'+e.message_time+'</span></div><div class="col-6 py-1 bg-warning" style="background-color: rgb(148, 61, 230) ; color: black; border-radius: 50px "><span style="float: right">'+e.message +'</span></div><div class="col-3"><strong class="s_user"> : ' + e.username+ '</strong></div></div></div>';
    }
} );
