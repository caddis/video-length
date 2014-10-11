<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array (
	'pi_name' => 'Video Length',
	'pi_version' => '1.1.1',
	'pi_author' => 'Caddis',
	'pi_author_url' => 'http://www.caddis.co',
	'pi_description' => 'Return HH:MM:SS from inputted seconds.',
	'pi_usage' => Video_length::usage()
);

class Video_length {

	public $return_data = '';

	public function __construct()
	{
		$this->EE =& get_instance();

		// Get seconds
		$seconds = $this->EE->TMPL->fetch_param('seconds');

		$time = '';

		if ($seconds !== false and is_numeric($seconds)) {
			$seconds = floor($seconds);

			$hrs = floor($seconds / 3600 );
			$mins = floor(($seconds - ($hrs * 3600)) / 60);
			$secs = $seconds - (($hrs * 3600) + ($mins * 60));

			$hrs = ($hrs > 0) ? (($hrs < 10) ? '0' . $hrs : $hrs) . ':' : '';
			$mins = ($mins < 10) ? '0' . $mins : '' . $mins;
			$secs = ($secs < 10) ? '0' . $secs : $secs;

			$time = $hrs . $mins . ':' . $secs;
		}

		$this->return_data = $time;
	}

	public static function usage()
	{
		ob_start();
?>
Parameters:

seconds = '543'		// number of seconds to convert to HH:MM:SS

Usage:

{exp:video_length seconds="125"} outputs 02:05
<?php
		$buffer = ob_get_contents();

		ob_end_clean();

		return $buffer;
	}
}
?>