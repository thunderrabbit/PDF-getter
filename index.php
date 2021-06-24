<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>
  <head>
    <title>Index of /pdf</title>
  </head>
  <body>
    <h1>Babychan's Index of /pdf</h1>
    <h3>Look for the newest files at the top</h3>
    <h3 style="color:red">Click to <a href='/pdf/wipe_pdfs.php'>Permanently DELETE all PDFs in this list</a>. DANGER</h3>
    <h3>I love you!  BooooooOOOOoooooooffff!!!</h3>
    <pre>      <a href="?C=N;O=D">Name</a>                           <a href="?C=M;O=A">Last modified</a>
<?php
// https://stackoverflow.com/a/6155608/194309
// output PDF files and '.' and '..'
  date_default_timezone_set("Japan");
  $found_files_array = array();            // so we can sort them
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
        $found_files_array[] = array(
               'name' => $filename,
               'date' => date(DATE_RFC2822, $fileInfo->getMTime()),
             );
    }
  }

  // NOT Used since 2021 June 24: asort($found_files_array);   // automagically sorts them by key so they end up with newest files at the bottom
  rsort($found_files_array);   // automagically sorts them by key so they end up with newest files at the top
  foreach($found_files_array as $found_file)
  {
      echo '      <a href="' . $found_file['name'] . '">' . $found_file['name'] . '</a> ' . $found_file['date'] . "\n";
  }
?>	

<hr></pre>
</body></html>


