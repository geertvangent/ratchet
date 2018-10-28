var user;
var messages = [];

function updateMessages(msg){
    messages.push(msg);
    for(var x = 0; x < messages.length; x++){
        var name = messages[x].name;
        var message = messages[x].text;
        document.getElementsByClassName("output").innerHTML = name + ":" +message;
    }
}

//Is dit iets eigen aan JS of is dit eigen aan Ratchet/WebSockets?
var conn = new WebSocket('ws://localhost:8080');

//log connection in console
conn.onopen = function(e){
    console.log("Connection Established");
}

//Every time a new message is sent to the server, run this...
conn.onmessage = function(e){
    var msg = JSON.parse(e.data);
    updateMessages(msg);
}

//Every time a user sents a new message, run this...
function sendMessage(){
    var text = document.getElementById('send-msg').value;
    var msg = {
        user: user,
        text: text
    }
    //console.log(msg);
    updateMessages(msg);
    
}


/* function message(msg){
    conn.send(msg);
} */



