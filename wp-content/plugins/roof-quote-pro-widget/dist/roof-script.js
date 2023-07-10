var scriptUrl = document.getElementById('widget-script-url').value;
var script = document.createElement('script');
script.src = scriptUrl;
document.head.appendChild(script);