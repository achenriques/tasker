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


	require ("SiteCheck.php");
	require ("URLSourceArray.php");
	require ("ReportWriterHTML.php");
 
	$urlSource = new URLSourceArray(
   		array (		
			//front page
			"index.php", 			
			// links section
			"links/",
			"links/index.php?parent=4",
			"links/index.php?child=20",
			"links/submit.php",			
			// clubs section
			"clubs/",
			"clubs/index.php?country=14",           
			// news section
			"news/search.php"
			)
		);
	$siteCheck = new SiteCheck($urlSource, new ReportWriterHTML(), 80, "www.jugglingdb.com", "");
	$siteCheck->runCheck();
?>