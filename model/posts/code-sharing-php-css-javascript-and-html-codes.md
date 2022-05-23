#CODE: Sharing PHP, CSS, Javascript and HTML codes#

*Code sharing samples for programmers and designers.*

**PHP** code: 

```
function checkEmail($email) {
 $pattern = "/^[a-z0-9\._-]+"
 . "@"
 . "[a-z0-9][a-z0-9-]*"
 . "(\.[a-z0-9_-]+)*"
 . "\.([a-z]{2,6})$/i";
 return preg_match($pattern, $email);
}
```

**CSS** code: 

```
mark { background:#ccc; padding:0.05em 0.25em; }
a, a:visited { color:#AAAABB; }
a:hover, a:focus { color:#000000; }
article h3 {
  font-size: 1.4em;
  font-weight: 400;
  margin: 1.2em 0 1em;
}
```

**Javascript** code: 

```
function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1) ) + min;
}
```

**HTML** code: 

```
<!DOCTYPE html>
<html>
  <head>
    <title>Page &amp; Title</title>
  </head>
  <body class="not-front page-id-1 page-static page-contact not-logged">
    <h1 id="sitename">{$smarty.SITE_NAME}</h1>
    <p>This is a <a href="#" title="test link">paragraph</a>.</p>
  </body>
</html>
```

---
[#code](/?filter=code)
[#PHP](/?filter=php)
[#CSS](/?filter=css)
[#Javascript](/?filter=javascript)