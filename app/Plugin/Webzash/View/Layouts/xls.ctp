<?php


echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:html=\"http://www.w3.org/TR/REC-html40\">";

echo "\n<Worksheet ss:Name=\"" . "Report" . "\">\n<Table>\n";

echo $this->fetch('content');

echo "</Table>\n</Worksheet>\n";

echo "</Workbook>";
