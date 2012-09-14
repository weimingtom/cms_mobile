<?php
function redirect_on_error($e) {
	//ob_end_clean();
	
	if(is_a($e, "MysqlException")) {
 		print_r($e);
 	}
 	/*else {
  		//include("/error.html");
  		echo '<b>Uncatch exception</b><br />';
  		print_r($e);
 	}*/
 	

	$e->handle();
}

error_reporting(E_ALL);
set_exception_handler("redirect_on_error");

$message = false;
$ABadfields[] = array();

class MyException extends Exception {

	/**
	 * Indicates the production mode, which prints nothing, and
	 * warns by mail the administrator
	 *
	 * @since 0.1
	 */
	const PRODUCTION = 1;

	/**
	 * Indicates the debug mode, which prints a developer-friendly HTML message
	 */
	const DEBUG = 2;

	/**
	 * Selected mode for exception handle
	 *
	 * @var integer
	 * @since 0.1
	 */
	private $mode;

	/**
	 * Create an exception handler.
	 *
	 * @param string $msg Exception message
	 * @param integer $code Exception code (default: 0)
	 * @param integer $mode Optional mode (default: DEBUG)
	 * @since 0.1
	 */
	public function __construct($msg='', $code=0, $mode=0) {

		parent::__construct($msg, $code);

		$this->mode = ($mode == 0) ? 2 : $mode;

	}

	/**
	 * Handle the exception, according to the Cowlibri mode (DEBUG or PRODUCTION)
	 *
	 * Call this method in the "catch" block. In DEBUG mode, a developper-friendly
	 * message will be displayed. In PRODUCTION mode, an alert can be send to the
	 * administrator, and the exception is logged.
	 *
	 * @since 0.1
	 */
	public function handle() {

		switch($this->mode) {

			case MyException::PRODUCTION:
				$data = $this->dump();

				$exc = get_class($this);
				$txt = "# $exc exception\n";
				$txt .= sprintf("%s-%2s-%2s %2s:%2s:%2s\n",date('Y'),date('m'),date('d'),date('h'),date('i'),date('s'));
				$txt .= "Thrown at:\n  ".$data['file'].':'.$data['line'].' with #'.$data['code']." error code\n";
				$txt .= "Debug backtrace:\n";

				foreach($data['trace'] as $trace) {
					$txt .= '  '.$trace['function'].'@'.$trace['file'].':'.$trace['line']."\n";
				}

				$file = $_SERVER['VIRTUAL_ROOT'].'/tmp/VU-'.time().'-'.$exc.'.exception';
				file_put_contents($file,$txt);
				break;

			// DEBUG mode, affichage d'un message � l'�cran
			case MyException::DEBUG:
				$data = $this->dump();

				$output = '<div style="padding:25px;border:5px red solid;font-family:fixed;font-size:11pt;">';
				$output .= '<p style="font-size:2em;font-weight:bold;">An exception has been thrown ! Some informations:</p>';
				$output .= '<p style="border:1px solid black;padding:5px;">'.$data['message'].'</p>';
				$output .= 'Exception was thrown at:';
				$output .= '<ul>';
				$output .= '<li>File: '.$data['file'].'</li>';
				$output .= '<li>Line: '.$data['line'].'</li>';
				$output .= '<li>Code: '.$data['code'].'</li>';
				$output .= '</ul>';
				$output .= '<p>Stack trace:</p>';

				foreach($data['trace'] as $trace) {
					$output .= '<ul style="padding-bottom:5px;">';
					$output .= '<li>File: '.$trace['file'].'</li>';
					$output .= '<li>Line: '.$trace['line'].'</li>';
					$output .= '<li>Function: '.$trace['function'].'</li></ul>';
				}
				$output .= '</div>';

				echo $output;
				break;
		}

	}

	/**
	 * Return an array with all exception informations
	 *
	 * <p>The array looks-like :
	 *  <ul>
	 *   <li>file where the exception was thrown</li>
	 *   <li>line where the exception was thrown</li>
	 *   <li>message giving some informations</li>
	 *   <li>code error</li>
	 *   <li>trace, numeric keys array, where each item contain: file, line and function name</li>
	 *  </ul></p>
	 * <p>Each file path is reduced according to the specified base in the configuration.</p>
	 *
	 * @return array Exception informations
	 */
	public function dump() {
		// build the trace
		$completeTrace = $this->getTrace();
		$trace = array();
		foreach($completeTrace as $val) {
			// each item indicates the file, the line and the function
			$trace[] = array(
					'file'=>$this->getShortPath($_SERVER['VIRTUAL_ROOT'], $val['file']),
					'line'=>isset($val['line']) ? $val['line'] : '-',
					'function'=>isset($val['class']) ? ($val['class'].'::'.$val['function']) : (isset($val['function']) ? $val['function'] : '-')
				);
		}

		// complete dump
		$dump = array(
			'line'=>$this->line,
			'message'=>$this->message,
			'code'=>$this->code,
			'file'=>$this->getShortPath($_SERVER['VIRTUAL_ROOT'], $this->file),
			'trace'=>$trace
		);

		return $dump;
	}

	/**
	 * Reduce a path starting from a base.
	 *
	 * <code>
	 * $base = 'test/0.4/'
	 * $path = '/var/www/html/php5/haricow/0.4/haricow/test/0.4/haricow/runTests.php';
	 * echo $this->getShortPath($base,$path);
	 * </code>
	 * Will output : "haricow/runTests.php"
	 *
	 * @param string $base Base after which the path is reduced
	 * @param string $path Path to reduce
	 * @return string The reduced path
	 * @since 0.1
	 */
	protected function getShortPath($base,$path) {
		if(empty($base)) {
			return $path;
		}

		// normalize slash, between unix and windows paths
		$base = str_replace('\\','/',$base);
		$path = str_replace('\\','/',$path);

		// get the path starting from the base
		$sp = strstr($path, $base);
		$sp = explode('/',$sp);

		// count how many directory the base has
		$nb = substr_count($base,'/');
		if($base{strlen($base)-1} != '/') {
			// count the last directory, if the base does not end by a slash
			$nb++;
		}

		while($nb--) {
			// remove each base's directory from the short path
			array_shift($sp);
		}

		// return a short path, using, unix style
		return implode($sp,'/');
	}
}


/******************** MYSQL ***************************/

class MysqlException extends MyException {
	public $backtrace;
	public function __construct($message=false, $code=false) {

		if(!$message) {
			$this->message = mysql_error();
		}
        else $this->message = $message;
		if(!$code) {
			$this->code = mysql_errno();
		}
        else $this->code = $code;

        //$this->backtrace = debug_backtrace();

        parent::__construct($message, $code);
	}
}

/********************  SESSION  ***************************/
class SessionEndException extends MyException{
	public function __construct($message=false, $code=0) {
		parent::__construct($message, $code);
	}
}

/******************** DATA - FORM - FIELD ***************************/

class DataException extends MyException {
	public $field = array();
	public function __construct($field, $message=false, $code=0) {
		if(is_array($field)) $this->field = array_merge($field, $this->field);
		else $this->field[] = $field;
		parent::__construct($message, $code);
	}
}

class RequiredDataException extends DataException {
	function __construct($field, $message=false, $code=0){
		parent::__construct($field, $message, $code);
	}
}

class BadDataException extends DataException {
	function __construct($field, $message=false, $code=0){
		parent::__construct($field, $message, $code);
	}
}

class UploadException extends DataException {
	function __construct($field, $message=false){
		parent::__construct($field, $message);
	}
}


Class FileException extends MyException {
	public function __construct($message=false) {
		parent::__construct($message);
	}

}
?>