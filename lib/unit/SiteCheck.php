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

//abstract class for writing a report based on the site check 
class ReportWriter
{
	function startReport() {}
	function endReport() {}	
	function addItem($url, $errors) {}
	function addItemMessage($success, $url, $message) {}
}

//abstract class which provides SiteCheck with URLs to verify
class URLSource
{
	function getNext() {}	
	function hasNext() {}
}



class SiteCheck
{
	var $urlSource;
	var $reportWriter;
	var $port;
	var $host;
	var $dir = "";
	
	/**
	* Constructor
	*
	* @param URLSource 		$urlSource 		the class which provides URLs
	* @param ReportWriter 	$reportWriter 	the class which generates the report
	* @param integer	 	$port 			port of server
	* @param string	 		$host 			host address
	* @param string	 		$dir 			root directory
	*/
	function SiteCheck($urlSource, $reportWriter, $port, $host, $dir)
	{
		set_time_limit(21600);
		
		$this->urlSource = $urlSource;
		$this->reportWriter = $reportWriter;
		$this->port = $port;
		$this->host = $host;
		$this->dir = $dir;
	}
	
	/**
	* This is the main method for this class. When it is invoked the SiteChecker
	* will proceed to check all the URLs provided by the URLSource, with the 
	* results being sent to the ReportWriter.
	*/
	function runCheck()
	{
		$this->reportWriter->startReport();
		
		while($this->urlSource->hasNext())
		{
			//create the full URL from the host address and port number
			$request = $this->urlSource->getNext();
			$url = "http://".$this->host.":".$this->port;
			if ($this->dir!="")
				$url = $url."/".$this->dir."/".$request;
			else
				$url = $url."/".$request;

			$page = $this->fetchPage($url);	//print_r($page);die;
			if ($page["error"])
			{
				//report an un-expected error
				$this->reportWriter->addItemMessage(false, $url, $page["error"]);
			}
			else if ($page["headers"]["status_code"]!=200)
			{
				//report an HTTP error
				$this->reportWriter->addItemMessage(false, $url, "Page not loaded, error code: ".$page["headers"]["status_code"]);
			}
			else
			{
				//report PHP page errors
				$errors = $this->checkForErrors($page["content"]);			
				$this->reportWriter->addItem($url, $errors);								
			}
		}
		
		$this->reportWriter->endReport();
	}
	
	/**
	* This method checks the page provided to deteremine whether their are any PHP
	* errors. Any errors that are found are stored in the array which this 
	* method returns
	*
	* @param string	 $page the HTML of the page to check
	*/
	function checkForErrors($page)
	{
		$errorCount=0;
		
		//Regular expressions use to identify the various parts of the standard PHP errors
		$error = "[a-zA-Z ]*";
		$message = "[;=':_.<>\(\)/a-zA-Z0-9 ]*";
		$file = "[_.\(\)/a-zA-Z0-9 ]*";
		$line = "[0-9]*";
		
		while ( preg_match("<b>($error)</b>: ($message) in <b>($file)</b> on line <b>($line)</b>", $page, $matches))
		{
			$pageErrors[$errorCount] = new ErrorMessage($matches[0], $matches[1], $matches[2], $matches[4], $matches[3]);				
			$errorCount++;
			
			//remove this error message from the page, so that we can check for further errors
			$page = str_replace($matches[0], "", $page);
		}
		
		return $pageErrors;
	}
	
	/**
	* This method retreives the HTML docment referred to by the URL. It
	* also extracts the header information.
	*
	* @param string	 $url the URL to retrieve
	*/
	function fetchPage($url)
	{

		//$content = file_get_contents($url);

		//$content = file_get_contents("http://localhost/tasker/vistas/v-dashboard.php");
		//var_dump($http_response_header);




//die;


		$url_parsed = parse_url($url);
		$host = $url_parsed["host"];
		$port = $url_parsed["port"];
		$content = null;
		if ($port==0)
			$port = 80;
		$path = $url_parsed["path"];
	
		if (empty($path))
		$path="/";
	
		//add on any query string
		if (isset($url_parsed["query"]) && $url_parsed["query"] != "")
			$path .= "?".$url_parsed["query"];
			
		//open the socket and send our HTTP request
		$fp = fsockopen($host, $port, $errno, $errstr, 30);
		if ($fp)
		{
			$out = "GET $path HTTP/1.0\r\nHost: $host\r\n\r\n";
			fwrite($fp, $out);
			
			while (!feof($fp))
			{
				$output=fgets($fp, 255);
				$content.=$output;
				
				//determine whether we have reached the end of the header section
				if (!isset($header))	if($output=="\n" || $output == "\r\n" || $output == "\n\l")
				{
			    	$header = $content;
					$content = '';
				}	
			}
			fclose($fp);	
			
			return array("headers" => $this->getHeaders($header), "content" => $content);
		}
		else
			return array("error" => "Unable to open a connection");
	}
	
	/**
	* This method takes the raw header information and splits it into
	* an array
	*
	* @param string	 $headers the header in a raw format
	*/
	function getHeaders($headers)
	{
		$head = $this->parseHeaders($headers);

		$hdrs = array();
		$hdrs['version'] = '1.1';
		$hdrs['status_code'] = $head['reponse_code'];
		$hdrs['status_text'] = 'OK';
		//$hdrs['version'] = '1.1';

		return $hdrs;

		/*
		$array = explode("\n",$headers);
		for($i=0;$i<count($array);$i++)
		{
			if(  preg_match("([A-Za-z]+)/([0-9]\.[0-9]) +([0-9]+) +([A-Za-z]+)",$array[$i],$r)  )
			{
				$hdrs['version'] = trim($r[2]);
				$hdrs['status_code'] = (int)trim($r[3]);
				$hdrs['status_text'] = trim($r[4]);
	    	}
	    	elseif(preg_match("([^:]*): +(.*)",$array[$i],$r))
	    	{
				$hdr = preg_replace("-","_",trim(strtolower($r[1])));
				$hdrs[$hdr] = trim($r[2]);
		    }
		}

		return $hdrs;*/
	}

	function parseHeaders( $headers )
	{
		print_r($headers);return;die;

		$head = array();
		foreach( $headers as $k=>$v )
		{
			$t = explode( ':', $v, 2 );
			if( isset( $t[1] ) )
				$head[ trim($t[0]) ] = trim( $t[1] );
			else
			{
				$head[] = $v;
				if( preg_match( "#HTTP/[0-9\.]+\s+([0-9]+)#",$v, $out ) )
					$head['reponse_code'] = intval($out[1]);
			}
		}
		return $head;
	}

//print_r(parseHeaders($http_response_header));


}
/*
[0] => HTTP/1.1 200 OK
[reponse_code] => 200
[Date] => Fri, 01 May 2015 12:56:09 GMT
[Server] => Apache
[X-Powered-By] => PHP/5.3.3-7+squeeze18
[Set-Cookie] => PHPSESSID=ng25jekmlipl1smfscq7copdl3; path=/
[Expires] => Thu, 19 Nov 1981 08:52:00 GMT
[Cache-Control] => no-store, no-cache, must-revalidate, post-check=0, pre-check=0
[Pragma] => no-cache
[Vary] => Accept-Encoding
[Content-Length] => 872
[Connection] => close
[Content-Type] => text/html
*/
?>
