<?php
	

class ProcessFeeds {
	protected $connection;
	public $error;
        public $config;
	public $file;

	public function __construct() {
	$envs = getenv('RF_ENV');
	$envs = explode('|', $envs);
	$d = realpath(dirname(__FILE__).'/../');
	$env = '';
	foreach($envs as $e) {
	    if(strstr($e, $d)!== false) {
		$envArr = explode(':', $e);
		$env = $envArr[1];
		break;
	    }
	}

	    $configs = parse_ini_file('config.ini', true);
	    $this->config = $configs[$env];	
	    $this->file = $this->config['feedlist'];
            $this->connectDb();
    }

    public function connectDb() {
        try {
            $this->connection = mysql_connect($this->config['db']['host'], $this->config['db']['username'], $this->config['db']['password']);
            if (!$this->connection) {
                $this->error = "Connection failed";
            }
            mysql_select_db($this->config['db']['database']);
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }
    }


	/**
	**This function will create a list of feed urls, 
	**which are scheduled to be pulled in next five minute slot
	**/

	function buildList() {
		#$file = '/var/www/projects/readfiend/feedlist.txt';		
		$sql = "SELECT feeds.id, feeds.url, feeds.schedule, providers.name FROM feeds LEFT JOIN providers ON feeds.provider = providers.id WHERE 1";
		$result = mysql_query($sql, $this->connection);
		$i = 0;
		while($row = mysql_fetch_assoc($result)) {
			$urlArray = parse_url($row['url']);
			$url = str_replace("/", "_", $urlArray['path']);
			if($this->checkSchedule($row['schedule'])) {
				$feedLine = strtolower($row['name']). "|" . $row['url'] . "|" . substr($url,1).".xml"."\n";
				file_put_contents($this->file, $feedLine, FILE_APPEND | LOCK_EX);
				echo date("Y-d-m H:i A"). "  " . $row['url'] . "   (URL ADDED)". "\n";

			}
			$i++;
		}

	}

	/*
	* Function to check if a feed is scheduled for update
	* return Boolean
	*/	
	function checkSchedule($slot = "") {
		//$slotArray = explode()
		return true;
	}
}

$file = '/var/www/projects/readfiend/feedlist.txt';
$feedsObj = new ProcessFeeds();
file_put_contents($feedsObj->file, "");
$feedsObj->buildList();
