<?php
	
	class Vertex {
		static $verbose = FALSE;
		private $_x = 0.0;
		private $_y = 0.0;
		private $_z = 0.0;
		private $_w = 1.0;
		private $_color;
		public function __construct(array $coord) {
			$this->_x = floatval($coord['x']);
			$this->_y = floatval($coord['y']);
			$this->_z = floatval($coord['z']);
			if (array_key_exists('w', $coord))
				$this->_w = floatval($coord['w']);
			if (array_key_exists('color', $coord))
				$this->_color = $coord['color'];
			else
				$this->_color = new Color( array('rgb' => 0xffffff) );
			if (Vertex::$verbose === TRUE)
			{
				printf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f, %s ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->__toString());
			}
		}
		public function __destruct() {
			if (Vertex::$verbose === TRUE)
				printf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f, %s ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->__toString());
		}
		public function __toString() {
			if (Vertex::$verbose === TRUE)
			{
				return sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f, %s )", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->__toString());
			}
			else
			{
				return sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f )", $this->_x, $this->_y, $this->_z, $this->_w);
			}
		}
		public function doc() {
			return file_get_contents("Vertex.doc.txt");
		}
		public function __get($property) {
			return $this->$property;
		}
		public function __set($property, $value) {
			if (property_exists($this, $property))
				$this->$property = $value;
		}
	}
	
?>