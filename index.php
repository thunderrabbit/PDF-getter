<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>
  <head>
    <title>Index of /pdf</title>
  </head>
  <body>
    <h1>Babychan's Index of /pdf</h1>
    <h3>Look for the newest files at the bottom</h3>
    <h3>I love you!  BooooooOOOOoooooooffff!!!</h3>
    <pre>      <a href="?C=N;O=D">Name</a>                           <a href="?C=M;O=A">Last modified</a>
<?php
// https://stackoverflow.com/a/6155608/194309
// output PDF files and '.' and '..'
  date_default_timezone_set("Japan");

  foreach (new DirectoryIterator('.') as $fileInfo)
  {
    if($fileInfo->isDot())
    {
        $filename = $fileInfo->getFilename();
        echo '      <a href="' . $filename . '">' . $filename . '</a> ' . "\n";
    }
    else if($fileInfo->getExtension() == "pdf")
    {
        $filename = $fileInfo->getFilename();
        echo '      <a href="' . $filename . '">' . $filename . '</a> ' . date(DATE_RFC2822, $fileInfo->getMTime()) . "\n";
    }
  }
?>	
      <hr></pre>
</body></html>


