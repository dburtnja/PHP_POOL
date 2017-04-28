<?php

	class Color {
		static $verbose = FALSE;
		public $red;
		public $green;
		public $blue;
		public function __construct(array $rgb) {
			if (array_key_exists('rgb', $rgb))
			{
				$split = 0xffffff & intval($rgb['rgb']);
				$this->red = (0xff0000 & $split) >> 16;
				$this->green = (0xff00 & $split) >> 8;
				$this->blue = (0xff & $split);
			}
			else
			{
				$this->red = intval($rgb['red']);
				$this->green = intval($rgb['green']);
				$this->blue = intval($rgb['blue']);
			}
			if (Color::$verbose === TRUE){
				printf("Color( red: %3d, green: %3d, blue: %3d ) constracted.\n", $this->red, $this->green, $this->blue);
			}
		}
		public function __destruct(){
			if (Color::$verbose === TRUE)
			printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue);
		}
		public function __toString() {
			return sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue);
		}
		public function add(Color $rhs)
		{
			return new Color(array(
				'red' => $this->red + $rhs->red,
				'green' => $this->green + $rhs->green,
				'blue' => $this->blue + $rhs->blue));
		}
		public function sub(Color $rhs)
		{
			return new Color(array(
				'red' => $this->red - $rhs->red,
				'green' => $this->green - $rhs->green,
				'blue' => $this->blue - $rhs->blue));
		}public function mult($f)
		{
			return new Color(array(
				'red' => $this->red * $f,
				'green' => $this->green * $f,
				'blue' => $this->blue * $f));
		}
		static function doc(){
			return file_get_contents("Color.doc.txt");
		}
	}
	
?>