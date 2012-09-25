var console = console;
(function(ns){
  "use strict";
  var button = document.querySelector("#button");
  var xhr = new XMLHttpRequest();
  var showResult = function(data){console.log(data);};
  var onreadystatechange = function(event){
    var target = event.target;
    console.log(event,target);
    if(target.readyState==4 && target.status===200){
      showResult(target.response);
    }
  };
  var main = function(){
    xhr.open("POST","",true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = onreadystatechange;
    xhr.send(JSON.stringify({a:1,b:2,c:3}));
  };
  button.addEventListener('click',function(event){main();});
})(window);