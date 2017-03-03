<?php
$dbconn = pg_connect("
	host     = ec2-176-34-111-152.eu-west-1.compute.amazonaws.com
	dbname   = ddironoubdcdin
	user     = zaqnsiwfubvdlf
	password = dfd29c90a1108174bde464b59bea334b3eacc604eb29b2c490dec86cee54d481
")or die('Could not connect: ' . pg_last_error());

switch ($_GET["comand"])
{
    case "create": 
    {
        try 
        {  
            $query = "CREATE TABLE messages (message TEXT NOT NULL)";
            $result = pg_query($query) or die(pg_last_error());
            echo "SUCCESS table users is created";
        } 
        catch (Exception $e) 
        {
            echo "ERROR: Database are not created.";
        }    
    } break; 
	
	case "length": 
    {
		$query = "SELECT * FROM messages";
		$result = pg_query($query) or die(pg_last_error());
		echo pg_num_rows($result);
				
    } break;

    case "get": 
    {
		$query = "SELECT * FROM messages";
		$result = pg_query($query) or die(pg_last_error());
		$text = substr($text.length - 2);
		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC))
		{
			$text .= $line["message"];
		}
		$text = substr($text, 0, $text.length - 2);
		echo $text;		
    } break;
	
    case "set": 
    {
		$query = "INSERT INTO messages (message) VALUES ('$_GET[text]')";
		$result = pg_query($query) or die(pg_last_error());
    } break;
	
	case "delete": 
    {
        $query = "DELETE FROM films";
		$result = pg_query($query) or die(pg_last_error());
        
    } break;
    default: 
    {
        echo "ERROR: Unknow comand.";
    } break;
}
pg_free_result($result);
pg_close($dbconn);
?>
