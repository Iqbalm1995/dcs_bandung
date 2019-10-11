<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if (!function_exists('slug')) {
		function slug($judul=''){

			$judul	= str_replace(array('/','.'), ' ', $judul);
			$slug	= url_title($judul, '-',TRUE);

			return $slug;

		}
	}
