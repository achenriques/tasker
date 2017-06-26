<?
/*
Copyright (C) 2004  C.N.Eberhardt (webmaster@jugglingdb.com)

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

require_once("ErrorMessage.php");

//A simple report writer 
class ReportWriterEmail extends ReportWriter
{
	
	var $report = "";
	var $errorCount = 0;
	var $fromAddress;
	var $toAddress;
	
	function ReportWriterEmail($from, $to)
	{
		$this->fromAddress = $from;
		$this->toAddress = $to;
	}
	
	function startReport()
	{}
	
	function endReport()
	{
		if ($this->errorCount>0)
		{
			$this->sendMail($this->fromAddress, $this->toAddress, "Page failures", $this->report, "");
		}
	}	
	
	function addItem($url, $errors)
	{
		if (!is_null($errors) && count($errors)>0)
		{			
			while (list(, $error) = each($errors)) 
			{
				$this->errorCount++;
				
				$this->report.= $url.":\n".$error->getType().", ".$error->getMessage()." ".
								$error->getFile()." at line ".$error->getLine()."\n\n";
			}
			
		}
	}	
	
	function addItemMessage($success, $url, $message)
	{
		$this->errorCount++;
		$this->report.= $url.": ".$message;
	}	
	
	function sendMail($fromaddress, $toaddress, $subject, $body, $headers)
	{ 
		$fp = popen('/usr/sbin/sendmail -t -f '.$fromaddress.' '.$toaddress,"w"); 
		if(!$fp) return false; 
		fputs($fp,"From:".$fromaddress."\r\n"); 
		fputs($fp, "To: $toaddress\r\n"); 
		fputs($fp, "Subject: ".$subject."\r\n"); 
		fputs($fp, $headers."\r\n"); 
		fputs($fp, $body); 
		fputs($fp, "\r\n"); 
		pclose($fp); 
		return true; 
	}
}

?>
