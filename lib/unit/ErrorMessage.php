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

//class which represents an error
class ErrorMessage
{	
	var $html;
	var $type;
	var $message;
	var $line;
	var $file;	
	
	function ErrorMessage($html, $type, $message, $line, $file)
	{
		$this->html = $html;
		$this->type = $type;
		$this->message = $message;
		$this->line = $line;
		$this->file = $file;
	}
	
	function getLine() 		{	return $this->line;	}
	function getMessage() 	{	return $this->message;	}
	function getType() 		{	return $this->type;	}
	function getFile() 		{	return $this->file;	}
	function getHtml() 		{	return $this->html;	}
}
?>