<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array (
	'pi_name' => 'Video Length',
	'pi_version' => '1.0',
	'pi_author' => 'Michael Leigeber',
	'pi_author_url' => 'http://www.caddis.co',
	'pi_description' => 'Return MM:SS from inputted seconds.',
	'pi_usage' => Video_length::usage()
);

class Video_length
{
	public $return_data = '';

	function __construct()
	{
		$this->EE =& get_instance();

		// Get seconds
		$seconds = $this->EE->TMPL->fetch_param('seconds');

		$time = '';
		
		if ($seconds && is_numeric($seconds))
		{
			$seconds = ceil($seconds);
		
			$hours = floor( $seconds / 3600 );
			$mins = floor( ( $seconds - ( $hours * 3600) ) / 60 );
			$s = $seconds - ( ( $hours * 3600 ) + ( $mins * 60) );

			$mins = ($mins < 10 ? '0' . $mins : '' . $mins);
			$s = ($s < 10 ? '0' . $s : '' . $s); 

			$time = ($hours > 0 ? $hours . ':' : '') . $mins . ':' . $s;
		}
		
		$this->return_data = $time;
	}

	function usage()
	{
		ob_start(); 
?>
Parameters:

seconds = '543'		// number of seconds to convert to MM:SS

Usage:

{exp:video_length seconds="125"} outputs 02:05
<?php
		$buffer = ob_get_contents();
	
		ob_end_clean(); 

		return $buffer;
	}
}
?>
