var http = require('http');
var url  = require('url');

http.createServer(function(req,res){
    res.writeHead(200,{'Content-Type':"text/html"});
    var q = url.parse(req.url)
    res.write("Hello World");
    res.end();
}).listen(9001);