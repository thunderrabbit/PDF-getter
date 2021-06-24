<?php

$expected_path = "/home/thundergoblin/b.robnugen.com/pdf";   // add a modicum of awareness so we don't Terminate everything
$realpath = realpath("");

if($expected_path == $realpath)
{
  foreach (new DirectoryIterator('.') as $fileInfo)
  {
    if($fileInfo->getExtension() == "pdf")
    {
        $filename = $fileInfo->getFilename();
        unlink($filename);
    }
  }
  echo "Cleaned up.  Click to <a href='/pdf/'>go back to index</a>.";
} else {
  echo "Where am I?";
}
