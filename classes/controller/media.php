<?php

class Controller_Media extends Controller {

	public function action_index()
	{
		// build file name
		$filename = APPPATH.'media/'.$this->request->param('folder').'/'.$this->request->param('file');

		// check if file exists on disk
		if ( ! file_exists($filename))
		{
			return $this->response->status(404);
		}

		// build cache name
		$cachename = md5($filename);

		// set file type
		$ext = pathinfo($this->request->param('file'), PATHINFO_EXTENSION);

		// fix less extension
		if ($ext == 'less')
		{
			$ext = 'css';
		}

		// check if cached version exists
		if ( ! file_exists(APPPATH.'cache/media/'.$cachename) || isset($_GET['nocache']))
		{
			// get file contents
			$data = file_get_contents($filename);

			// proccess file contents
			switch ($this->request->param('folder'))
			{
				case 'css':
				$data = self::parse_css($data);
				break;

				case 'less':
				$data = $this->parse_less($data);
				break;

				case 'js':
				$data = self::parse_js($data);
				break;

				case 'img':
				$data = self::parse_img($filename);
				break;

			}

			// write contents to file
			$fh = fopen(APPPATH.'cache/media/'.$cachename, 'w');
			fwrite($fh, $data);
			fclose($fh);
		}

		// if successfully created cached copy
		if (file_exists(APPPATH.'cache/media/'.$cachename))
		{
			// load cached file contents
			$data = file_get_contents(APPPATH.'cache/media/'.$cachename);

			// check if client accepts gzip
			if ($this->request->accept_encoding('gzip'))
			{
				// set header and gzip contents
				$this->response->headers('content-encoding', 'gzip');
				$data = gzencode($data);
			}

			// check for e-tag
			$this->response->check_cache(sha1($this->request->uri()).filemtime($filename), $this->request);

			// set headers
			$this->response->headers('content-length', strlen($data));
			$this->response->headers('content-type',  File::mime_by_ext($ext));
			$this->response->headers('last-modified', date('r', filemtime($filename)));

			// write contents to response
			$this->response->body($data);
		}
		else
			throw new Kohana_Exception('Could not load cached file.');
	}

	/**
	 * parse less
	**/
	public function parse_less($data = NULL)
	{
		preg_match_all("#\@import(.*?)\;#s", $data, $imports);

		$url = substr($this->request->param('file'), 0, strrpos('/', $this->request->param('file')));

		foreach ($imports[1] as $k => $import)
		{
			$import = str_replace(array('url("', "url('", 'url(', '")', "')", ')', '"', "'"), NULL, $import);

			if (file_exists(APPPATH . '/media/less/' . $url . trim($import)))
			{
				$r = Request::factory('/media/less/' . $url . trim($import))
				->query('noless', TRUE)
				->execute();

				$data = str_replace($imports[0][$k], gzinflate(substr($r, 10, -8)), $data);
			}
			else
			{
				$data = str_replace($imports[0][$k], $imports[0][$k].'/* file not found */', $data);
			}
		}

		// load less parser
		require_once APPPATH.'vendor/lessphp/lessc.inc.php';

		// create instance of class
		$less = new lessc();

		// set indentation
		$less->indentChar = ' ';

		// parse less contents
		if ( ! $this->request->query('noless') && ! isset($_GET['noless']))
		{
			$data = $less->parse($data);
		}

		// force one-line layout
		$data = str_replace("\n", NULL, $data);
		$data = str_replace("}", " }\n", $data);

		return $data;
	}

	public static function parse_js($data = NULL)
	{
		return $data;
	}

	public static function parse_css($data = NULL)
	{
                $data = str_replace("\n", NULL, $data);
                $data = str_replace("}", " }\n", $data);

		return $data;
	}

	public static function parse_img($filename = NULL)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://www.smushit.com/ysmush.it/ws.php?');
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.65 Safari/535.11');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array('files' => '@'.$filename));

		$dump = curl_exec($ch);

		$result = json_decode($dump);

		return file_get_contents(urldecode($result->dest));
	}

}
